<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Cookie;
use yii\db\Query;

use app\models\Carrito;
use app\models\ProductoCarrito;
use app\models\Talla;
use app\models\Cliente;
use app\models\Pedido;
use app\models\ProductoPedido;
use app\models\DatosPago;

use \Conekta\Conekta;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class CarritoComponent extends Component
{

    private $transaction;
    private $cookie_id;
    private $user_id;
    private $where_carrito;

    private function identificador(){
        if(Yii::$app->user->isGuest){
            $cookie_id = Yii::$app->getRequest()->getCookies()->getValue('vocamx_cart');
            if(!$cookie_id){
                $cookie_id = uniqid(rand(10,99));
                $cookie = new Cookie([
                    'name' => 'vocamx_cart',
                    'value' => $cookie_id,
                    'expire' => time() + 86400 * 365,
                ]);
                Yii::$app->getResponse()->getCookies()->add($cookie);
            }
            $this->cookie_id = $cookie_id;
            $this->where_carrito = 'carrito.cookie_id = "'.$cookie_id.'"';
        }else{
            $this->user_id = Yii::$app->user->identity->id;
            $this->where_carrito = 'carrito.user_id = "'.$this->user_id.'"';
        }
    }

    public function addEmailToCart($email) {
        if (Yii::$app->user->isGuest) {
            $cookie_id = Yii::$app->getRequest()->getCookies()->getValue('vocamx_cart');
            $carrito = Carrito::find()
                ->where(['cookie_id' => $cookie_id])
                ->one();
            $carrito->email = $email;
            $carrito->update();
        } else {
            $carrito = Carrito::find()
                ->where(['user_id' => Yii::$app->user->identity->id])
                ->one();
            $carrito->email = $email;
            $carrito->update();
        }
    }

    public function switchUsuario(){
        $cookie_id = Yii::$app->getRequest()->getCookies()->getValue('vocamx_cart');
        if(!$cookie_id){
            return true;
        }
        $carrito = Carrito::find()->where('cookie_id="'.$cookie_id.'"')->one();
        if(!$carrito){
            return true;
        }
        $carrito->user_id = Yii::$app->user->identity->id;
        $carrito->cookie_id = null;
        return $carrito->save();
    }

    public function botonCarrito($imagen = false, $url = false){
        $this->identificador();
        $cantidad = Carrito::find()
        ->select(['COUNT(producto_carrito.cantidad) AS cantidad'])
        ->join('INNER JOIN', 'producto_carrito', 'producto_carrito.carrito_id = carrito.id')
        ->where($this->where_carrito)
        ->one();
        $cantidad_carrito = $cantidad->cantidad > 0 ? $cantidad->cantidad : '';
        return Html::a(
            Html::img($imagen).'<span id="carrito-span">'.$cantidad_carrito.'</span>',
            null,
            ['class' => 'bolsa', 'href' => $url]
        );
    }

    public function agregar($producto_id, $talla_id, $cantidad, $comentarios, $custom, $foto_id = null, $decoracion = null){
        $this->identificador();
        $carrito = new Carrito();
        if($this->cookie_id){
            $carrito = $carrito->idCarrito(true, $this->cookie_id);
        }else{
            $carrito = $carrito->idCarrito(false, $this->user_id);
        }
        if(!$carrito){
            return [
                'exito' => 0,
                'mensaje' => 'Error al agregar producto a carrito.'
            ];
        }

        $producto = ProductoCarrito::find()
        ->where(
            'carrito_id='.$carrito.
            ' AND producto_id='.$producto_id.
            ' AND talla_id='.$talla_id
            )
            ->one();
        if($producto){
            $producto->cantidad += $cantidad;
            if(!$producto->save()){
                return [
                    'exito' => 0,
                    'mensaje' => 'Error al actualizar producto en carrito.'
                ];
            }
        }else{
            $producto = new ProductoCarrito();
            $producto->carrito_id = $carrito;
            $producto->producto_id = $producto_id;
            $producto->talla_id = $talla_id;
            $producto->cantidad = $cantidad;
            $producto->personaliza_foto_id = $foto_id;
            if($comentarios !== ''){
                $producto->comentarios = $comentarios;
            }
            if(is_array($custom)){
                $producto->diseno = $custom['diseno'];
                $producto->linea1 = $custom['linea1'];
                $producto->linea2 = $custom['linea2'];
                $producto->linea3 = $custom['linea3'];
                if(isset($custom['coleccion'])){
                    $producto->imagen_personalizada = $custom['imagen'];
                }else{
                    $nombre_archivo = $producto->diseno.$producto->carrito_id.'-'.time().'.png';
                    $imagen = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $custom['imagen']));
                    file_put_contents(\Yii::getAlias('@frontend/web/images/productos/personalizadas/'.$nombre_archivo), $imagen);
                    file_put_contents(\Yii::getAlias('@backend/web/images/productos/personalizadas/'.$nombre_archivo), $imagen);
                    $producto->imagen_personalizada = 'productos/personalizadas/'.$nombre_archivo;
                }
            }
            if(is_array($decoracion)){
                $producto->color_decoracion = $decoracion['color'];
                $producto->medidas_decoracion = $decoracion['medidas'];
                $producto->costo_decoracion = $decoracion['costo'];
            }
            if(!$producto->save()){
                return [
                    'exito' => 0,
                    'mensaje' => 'Error al agregar producto a carrito.'
                ];
            }
        }
        return [
            'exito' => 1,
            'mensaje' => 'El producto se agregó al carrito.'
        ];
    }

    public function obtieneProductos(){

        $this->identificador();
        $ip = Yii::$app->geoip->ip();
        if ($ip->country == 'Mexico'){
            $productos = ProductoCarrito::find()
            ->select([
                'producto_carrito.id AS producto_carrito',
                'producto_carrito.diseno AS diseno',
                'producto_carrito.linea1 AS linea1',
                'producto_carrito.linea2 AS linea2',
                'producto_carrito.linea3 AS linea3',
                'producto_carrito.imagen_personalizada AS imagen_personalizada',
                'producto_carrito.personaliza_foto_id',
                'producto_carrito.color_decoracion',
                'producto_carrito.medidas_decoracion',
                'producto_carrito.costo_decoracion',
                'categoria.nombre AS categoria',
                'categoria.clave AS clave',
                'categoria.produccion AS produccion',
                'producto.id AS producto', 'producto.nombre AS nombre', 'producto.ean AS upc',
                'producto.sku AS sku','producto.id_facebook AS id_fb','talla.talla AS talla', 'talla.id AS talla_id',
                'producto_carrito.cantidad AS cantidad', 'precio.precio AS precio', 'precio.precio_descuento AS precio_descuento',
                'personaliza_foto.mensaje AS mensaje',
            ])
            ->from('carrito')
            ->join('INNER JOIN', 'producto_carrito', 'producto_carrito.carrito_id = carrito.id')
            ->join('INNER JOIN', 'producto', 'producto.id = producto_carrito.producto_id')
            ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
            ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
            ->join('INNER JOIN', 'talla', 'talla.id = producto_carrito.talla_id')
            ->join('LEFT JOIN', 'personaliza_foto', 'personaliza_foto.id = producto_carrito.personaliza_foto_id')
            ->where($this->where_carrito)
            ->all();
        } else {

            $productos = ProductoCarrito::find()
            ->select([
                'producto_carrito.id AS producto_carrito',
                'producto_carrito.diseno AS diseno',
                'producto_carrito.linea1 AS linea1',
                'producto_carrito.linea2 AS linea2',
                'producto_carrito.linea3 AS linea3',
                'producto_carrito.imagen_personalizada AS imagen_personalizada',
                'producto_carrito.personaliza_foto_id',
                'producto_carrito.color_decoracion',
                'producto_carrito.medidas_decoracion',
                'producto_carrito.costo_decoracion',
                'categoria.nombre AS categoria',
                'categoria.clave AS clave',
                'categoria.produccion AS produccion',
                'producto.id AS producto', 'producto.nombre AS nombre', 'producto.ean AS upc',
                'producto.sku AS sku','producto.id_facebook AS id_fb','talla.talla AS talla', 'talla.id AS talla_id',
                'producto_carrito.cantidad AS cantidad', 'precio.precio_usd AS precio', 'precio.precio_descuento_usd AS precio_descuento',
                'personaliza_foto.mensaje AS mensaje',
            ])
            ->from('carrito')
            ->join('INNER JOIN', 'producto_carrito', 'producto_carrito.carrito_id = carrito.id')
            ->join('INNER JOIN', 'producto', 'producto.id = producto_carrito.producto_id')
            ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
            ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
            ->join('INNER JOIN', 'talla', 'talla.id = producto_carrito.talla_id')
            ->join('LEFT JOIN', 'personaliza_foto', 'personaliza_foto.id = producto_carrito.personaliza_foto_id')
            ->where($this->where_carrito)
            ->all();
        }
        return $productos;
    }

    public function cantidadProductos(){
        $this->identificador();
        $productos = ProductoCarrito::find()
            ->select(['SUM(producto_carrito.cantidad) AS cantidad'])
            ->from('carrito')
            ->join('INNER JOIN', 'producto_carrito', 'producto_carrito.carrito_id = carrito.id')
            ->where($this->where_carrito)
            ->one();
        if($productos)
            return $productos->cantidad;
        return 0;
    }
    public function cantidadChamarras(){
        $this->identificador();
        $productos = ProductoCarrito::find()
            ->select(['SUM(producto_carrito.cantidad) AS cantidad'])
            ->from('carrito')
            ->join('INNER JOIN', 'producto_carrito', 'producto_carrito.carrito_id = carrito.id')
            ->join('INNER JOIN', 'producto', 'producto_carrito.producto_id = producto.id')
            ->where($this->where_carrito)
            ->andWhere(['!=', 'producto.categoria_id', '7'])
            ->andWhere(['!=', 'producto.categoria_id', '8'])
//        var_dump($productos->createCommand()->getRawSql());exit;
            ->one();
        if($productos)
            return $productos->cantidad;
        return 0;
    }
    public function cantidadProductos2(){
        $this->identificador();
        $productos = ProductoCarrito::find()
            ->select(['SUM(producto_carrito.cantidad) AS cantidad'])
            ->from('carrito')
            ->join('INNER JOIN', 'producto_carrito', 'producto_carrito.carrito_id = carrito.id')
            ->join('INNER JOIN', 'producto', 'producto_carrito.producto_id = producto.id')
            ->where($this->where_carrito)
            ->andWhere(['!=', 'producto.categoria_id', '7'])
            ->one();
        if($productos)
            return $productos->cantidad;
        return 0;
    }

    public function borrarCarrito(){
        $this->identificador();
        $carrito = new Carrito();
        if($this->cookie_id){
            $carrito = $carrito->idCarrito(true, $this->cookie_id);
        }else{
            $carrito = $carrito->idCarrito(false, $this->user_id);
        }
        if(!$carrito){
            return [
                'exito' => 0,
                'mensaje' => 'Error al agregar producto a carrito.'
            ];
        }
        $carrito = Carrito::findOne($carrito);
        if(!is_numeric($carrito->delete())){
            return false;
        }
        return true;
    }

    public function borrarProducto($producto, $talla){
        $this->identificador();
        $carrito = new Carrito();
        if ($this->cookie_id) {
            $carrito = $carrito->idCarrito(true, $this->cookie_id);
        } else {
            $carrito = $carrito->idCarrito(false, $this->user_id);
        }
        if (!$carrito) {
            return json_encode([
                'exito' => 0,
                'mensaje' => 'Error al encontrar carrito.'
            ]);
        }

        $producto = ProductoCarrito::find()
            ->where([
                'carrito_id'=>$carrito,
                'producto_id'=>$producto,
                'talla_id'=>$talla
            ])
            ->one();
        if($producto){
            if(!$producto->delete()){
                return json_encode([
                    'exito' => 0,
                    'mensaje'  => 'Error al borrar producto.'
                ]);
            }
        }

        return json_encode([
            'exito' => 1,
            'mensaje' => 'El carrito ha sido actualizado.',
        ]);
    }

    public function actualizar($params){
        if(empty($params)){
            return [
                'exito' => 0,
                'mensaje' => 'Error actualizando el carrito'
            ];
        }

        $connection = \Yii::$app->db;
        $this->transaction = $connection->beginTransaction();

        $this->identificador();

        $carrito = Carrito::find()
        ->where($this->where_carrito)
        ->one();

        $productos_carro = ProductoCarrito::find()->where('carrito_id='.$carrito->id)->all();
        foreach ($productos_carro as $producto_carro) {
            if(! $producto_carro->delete()){
                $this->transaction->rollback();
                return [
                    'exito' => 0,
                    'mensaje' => 'Error actualizando el carrito'
                ];
            }
        }

        foreach ($params as $value) {
            $producto = new ProductoCarrito();
            $producto->carrito_id = $carrito->id;
            $producto->producto_id = $value[id];
            $talla = Talla::find()
            ->where('talla="'.$value[talla].'"')
            ->one();
            $producto->talla_id = $talla->id;
            $producto->cantidad = $value[cantidad];
            if(!$producto->save()){
                $this->transaction->rollback();
                return [
                    'exito' => 0,
                    'mensaje' => 'Error actualizando el carrito'
                ];
            }
        }
        $this->transaction->commit();
        return [
            'exito' => 1,
            'mensaje' => 'El carrito se ha actualizado.'
        ];
    }

    public function modificarProducto($producto, $cantidad = false, $talla = false){
        $producto_carro = ProductoCarrito::findOne(['id' => $producto]);
        if ($producto_carro) {
            if ($cantidad) {
                $producto_carro->cantidad = $cantidad;
                if ($producto_carro->update()) {
                    return [
                        'exito' => 1,
                        'mensaje' => 'Exito al actualizar el carro'
                    ];
                }
            } else if ($talla) {
                $producto_carro->talla_id = $talla;
                if ($producto_carro->update()) {
                    return [
                        'exito' => 1,
                        'mensaje' => 'Exito al actualizar el carro'
                    ];
                }
            }
        }
        return [
            'exito' => 0,
            'mensaje' => 'Error al actualizar el carro'
        ];
    }

    public function finalizar($params){
        if(empty($params)){
            return [
                'exito' => 0,
                'mensaje' => 'Error finalizando compra, parametros'
            ];
        }

        $connection = \Yii::$app->db;
        $this->transaction = $connection->beginTransaction();

        $cliente = new Cliente();
        $cliente->nombre = $params[0][nombre_envio];
        $cliente->apellidos = $params[0][apellidos_envio];
        $cliente->calle = $params[0][calle_envio];
        $cliente->colonia = $params[0][colonia_envio];
        $cliente->correo = $params[0][correo_envio];
        $cliente->cp = $params[0][cp_envio];
        $cliente->estado = $params[0][estado_envio];
        $cliente->municipio = $params[0][municipio_envio];
        $cliente->num_ext = $params[0][numero_exterior_envio];
        $cliente->num_int = $params[0][numero_interior_envio];

        $validaGuardaCliente = $cliente->save();

        if(!$validaGuardaCliente){
            $this->transaction->rollback();
            // var_dump($cliente->getErrors());exit;
            return [
                'exito' => 0,
                'mensaje' => 'Error finalizando compra, cliente'
            ];
        }

        $pedido = new Pedido();
        $pedido->cliente_id = $cliente->id;
        $validaGuardaPedido = $pedido->save();

        if(!$validaGuardaPedido){
            $this->transaction->rollback();
            // var_dump($pedido->getErrors());exit;
            return [
                'exito' => 0,
                'mensaje' => 'Error finalizando compra, pedido'
            ];
        }

        $cookie_id = $this->cookieId();

        $carrito = Carrito::find()
        ->where('cookie_id="'.$cookie_id.'"')
        ->one();

        $productosCarrito = ProductoCarrito::find()
        ->select(['producto_carrito.*', 'producto.nombre AS nombre' ,'precio.precio AS precio'])
        ->from('producto_carrito')
        ->join('INNER JOIN', 'producto', 'producto.id = producto_carrito.producto_id')
        ->join('INNER JOIN', 'precio', 'precio.id = producto.precio_id')
        ->where('producto_carrito.carrito_id='.$carrito->id)
        ->all();

        $items = array();

        foreach ($productosCarrito as $productoCarrito) {
            $productop = new ProductoPedido();
            $productop->pedido_id = $pedido->id;
            $productop->producto_id = $productoCarrito->producto_id;
            $productop->talla_id = $productoCarrito->talla_id;
            $productop->cantidad = $productoCarrito->cantidad;
            // $producto = $productoCarrito->producto;
            // var_dump($productoCarrito->precio);exit;
            $productop->total = $productoCarrito->cantidad * $productoCarrito->precio;
            $validaGuardaProductoP = $productop->save();

            $item = array();
            $item['name'] = $productoCarrito->nombre;
            $item['unit_price'] = intval($productoCarrito->precio)*100;
            $item['quantity'] = $productoCarrito->cantidad;
            $items[]=$item;

            if(!$validaGuardaProductoP){
                $this->transaction->rollback();
                return [
                    'exito' => 0,
                    'mensaje' => 'Error finalizando compra, productos pedido',
                ];
            }
        }

        // var_dump($items);
        // $this->transaction->commit();

        $ini = parse_ini_file("private.ini");
        \Conekta\Conekta::setApiKey($ini[privateKey]);
        \Conekta\Conekta::setApiVersion("2.0.0");

        try{
            $order = \Conekta\Order::create(
                array(
                'currency' => 'MXN',
                'customer_info' => array(
                    'name'=>"Mario Perez",
                    'email'=>"usuario@example.com",
                    'phone'=>"+5215555555555"
                ),
                'line_items' => $items,
                'charges' => array(
                    array(
                        'payment_method' => array(
                            'type' => 'card',
                            "token_id" => $params[2][id]
                        )
                    )
                )
            ));
        } catch (\Conekta\ProcessingError $error){
            return [
                'exito' => 0,
                'mensaje' => $error->getMessage(),
            ];
        } catch (\Conekta\ParameterValidationError $error){
            return [
                'exito' => 0,
                'mensaje' => $error->getMessage(),
            ];
        } catch (\Conekta\Handler $error){
            return [
                'exito' => 0,
                'mensaje' => $error->getMessage(),
                ];
        }

        $datosPago = new DatosPago();
        $datosPago->orden_id = $order->id;
        $datosPago->monto = $order->amount/100;
        $datosPago->codigo_auth = $order->charges[0]->payment_method->auth_code;
        $datosPago->numeros_tarjeta = $order->charges[0]->payment_method->last4;
        $datosPago->marca = $order->charges[0]->payment_method->brand;
        $datosPago->tipo = $order->charges[0]->payment_method->type;

        $validaDatosPago = $datosPago->save();
        if(!$validaDatosPago){
            $this->transaction->rollback();
            return [
                'exito' => 0,
                'mensaje' => 'Error finalizando compra, datos del pago'
            ];
        }

        $pedido->datos_pago_id = $datosPago->id;
        $validaGuardaPedido = $pedido->save();

        if(!$validaGuardaPedido){
            $this->transaction->rollback();
            return [
                'exito' => 0,
                'mensaje' => 'Error actualizando el carrito, pedido'
            ];
        }

        $productos_carro_borrar = ProductoCarrito::find()->where('carrito_id='.$carrito->id)->all();
        foreach ($productos_carro_borrar as $producto_carro) {
            if(! $producto_carro->delete()){
                $this->transaction->rollback();
                return [
                    'exito' => 0,
                    'mensaje' => 'Error actualizando el carrito'
                ];
            }
        }

        $this->transaction->commit();

        return [
            'exito' => 1,
            'mensaje' => 'La compra ha finalizado de foma exitosa'
        ];

    }

    public function pagarCarrito($metodo,$envio){
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        $productos = array();
        $subtotal = 0;
        foreach($this->obtieneProductos() as $producto){
            $producto_pago = new Item();
            $producto_pago->setName($producto->nombre)
                ->setCurrency('MXN')
                ->setQuantity($producto->cantidad)
                ->setSku($producto->producto)
                ->setPrice($producto->precio);
            $subtotal += $producto->precio*$producto->cantidad;
            array_push($productos,$producto_pago);
        }
        $itemList = new ItemList();
        $itemList->setItems($productos);

        $details = new Details();
        $details->setShipping($envio)->setSubtotal($subtotal);

        $amount = new Amount();
        $amount->setCurrency('MXN')
            ->setTotal($subtotal+$envio)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Compra Bombers')
            ->setInvoiceNumber(uniqid());

        $baseUrl = "http://www.vocamx.blackrobot.mx";
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
            ->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        $request = clone $payment;

        try {
            $apiContext = $this->getApiContext(
                "AcVBiqL-eqMiYsOr5_GGw2C8hgOM40mHJsxlBu2LGnzqRdCcxhMeeywEY_POC_pJCKsbr9Zl1XcBK1ni",
                "ED-peJOPYNHhxwtnboZEsNd-USZfWjNpOTUNDIG359wVrM5VjuJQbduFnDY2dQnlMT-GOLas3TOWnDZ1"
            );
            $payment->create($apiContext);
        } catch (Exception $ex) {
            return false;
        }
        $approvalUrl = $payment->getApprovalLink();
        var_dump($approvalUrl);exit;
        return $approvalUrl;
    }

    private function getApiContext($clientId, $clientSecret){
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
                )
            );
        $apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                //'log.LogEnabled' => true,
                //'log.FileName' => '../PayPal.log',
                //'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => true,
            )
        );
        return $apiContext;
    }

    public function diasProduccion(){
        $produccion = 0;
        foreach($this->obtieneProductos() as $producto){
            if($produccion < $producto->produccion){
                $produccion = $producto->produccion;
            }
        }
        return $produccion;
    }
}
