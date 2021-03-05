<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\models\Foto;

/**
 * This is the model class for table "pedido".
 *
 * @property int $id
 * @property string $numero_pedido
 * @property string $costo_total
 * @property int $costo_envios
 * @property int $estado_pedido_id
 * @property int $cliente_id
 * @property int $datos_pago_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $cupon_id
 *
 * @property Am[] $ams
 * @property CargoOpenpay[] $cargoOpenpays
 * @property EnviaYa[] $enviaYas
 * @property PagoTienda[] $pagoTiendas
 * @property Paypal[] $paypals
 * @property Cliente $cliente
 * @property Cupon $cupon
 * @property DatosPago $datosPago
 * @property EstadoPedido $estadoPedido
 * @property PedidoEnvio[] $pedidoEnvios
 * @property ProductoPedido[] $productoPedidos
 * @property Review[] $reviews
 */
class Pedido extends \yii\db\ActiveRecord
{
    public $producto_pedido;
    public $categoria;
    public $producto;
    public $precio;
    public $precio_descuento;
    public $nombre;
    public $talla;
    public $talla_id;
    public $total;
    public $cantidad;
    public $foto;
    public $fecha;
    public $cliente;
    public $proveedor_envio;
    public $costo_envio;
    public $servicio_envio;
    public $estado;
    public $diseno;
    public $linea1;
    public $linea2;
    public $linea3;
    public $imagen_personalizada;
    public $id_facebook;
    public $id_cupon;
    public $clave;
    public $custom_photo;
    public $custom_mensaje;
    public $custom_comentarios;
    public $comentarios;
    public $sku;

    public $color_decoracion;
    public $medidas_decoracion;
    public $costo_decoracion;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['costo_total', 'costo_envios'], 'number'],
            [['estado_pedido_id', 'cliente_id'], 'required'],
            [['estado_pedido_id', 'cliente_id', 'datos_pago_id', 'cupon_id'], 'integer'],
            [['numero_pedido'], 'string', 'max' => 10],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['cupon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cupon::className(), 'targetAttribute' => ['cupon_id' => 'id']],
        ];
    }

    public function behaviors(){
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cliente_id' => 'Cliente ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'datos_pago_id' => 'Datos Pago ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAms()
    {
        return $this->hasMany(Am::className(), ['pedido_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargoOpenpays()
    {
        return $this->hasMany(CargoOpenpay::className(), ['pedido_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnviaYas()
    {
        return $this->hasMany(EnviaYa::className(), ['pedido_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagoTiendas()
    {
        return $this->hasMany(PagoTienda::className(), ['pedido_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaypals()
    {
        return $this->hasMany(Paypal::className(), ['pedido_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'cliente_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCupon()
    {
        return $this->hasOne(Cupon::className(), ['id' => 'cupon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPago()
    {
        return $this->hasOne(DatosPago::className(), ['id' => 'datos_pago_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoPedido()
    {
        return $this->hasOne(EstadoPedido::className(), ['id' => 'estado_pedido_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoEnvios()
    {
        return $this->hasMany(PedidoEnvio::className(), ['pedido_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoPedidos()
    {
        return $this->hasMany(ProductoPedido::className(), ['pedido_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['pedido_id' => 'id']);
    }

    public function productos($pedido){
        $ip = Yii::$app->geoip->ip();
        if($ip->country == 'Mexico'){
            $productos = $this->find()
            ->select([
                'producto_pedido.id AS producto_pedido',
                'precio.precio AS precio',
                'precio.precio_descuento AS precio_descuento',
                'categoria.nombre AS categoria',
                'categoria.clave AS clave',
                'producto.id AS producto', 'producto.nombre AS nombre',
                'producto.sku AS sku',
                'producto.id_facebook AS id_facebook',
                'talla.talla AS talla', 'talla.id AS talla_id',
                'producto_pedido.cantidad AS cantidad',
                'producto_pedido.total AS total',
                'producto_pedido.diseno AS diseno',
                'producto_pedido.linea1 AS linea1',
                'producto_pedido.linea2 AS linea2',
                'producto_pedido.linea3 AS linea3',
                'producto_pedido.imagen_personalizada AS imagen_personalizada',
                'producto_pedido.comentarios AS comentarios',
                'producto_pedido.color_decoracion AS color_decoracion',
                'producto_pedido.medidas_decoracion AS medidas_decoracion',
                'producto_pedido.costo_decoracion AS costo_decoracion',
                'personaliza_foto.custom_photo AS custom_photo',
                'personaliza_foto.mensaje AS custom_mensaje',
                'personaliza_foto.comentarios AS custom_comentarios',
            ])
            ->join('INNER JOIN', 'producto_pedido', 'producto_pedido.pedido_id = pedido.id')
            ->join('INNER JOIN', 'producto', 'producto.id = producto_pedido.producto_id')
            ->join('INNER JOIN', 'precio', 'producto.id = precio.producto_id')
            ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
            ->join('INNER JOIN', 'talla', 'talla.id = producto_pedido.talla_id')
            ->join('LEFT JOIN', 'personaliza_foto', 'personaliza_foto.id = producto_pedido.personaliza_foto_id')
            ->where('pedido.id ='.$pedido)
            ->all();
        } else{

            $productos = $this->find()
            ->select([
                'producto_pedido.id AS producto_pedido',
                'precio.precio_usd AS precio',
                'precio.precio_descuento_usd AS precio_descuento',
                'categoria.nombre AS categoria',
                'categoria.clave AS clave',
                'producto.sku AS sku',
                'producto.id AS producto', 'producto.nombre AS nombre',
                'producto.id_facebook AS id_facebook',
                'talla.talla AS talla', 'talla.id AS talla_id',
                'producto_pedido.cantidad AS cantidad',
                'producto_pedido.total AS total',
                'producto_pedido.diseno AS diseno',
                'producto_pedido.linea1 AS linea1',
                'producto_pedido.linea2 AS linea2',
                'producto_pedido.linea3 AS linea3',
                'producto_pedido.imagen_personalizada AS imagen_personalizada',
                'producto_pedido.comentarios AS comentarios',
                'producto_pedido.color_decoracion AS color_decoracion',
                'producto_pedido.medidas_decoracion AS medidas_decoracion',
                'producto_pedido.costo_decoracion AS costo_decoracion',
                'personaliza_foto.custom_photo AS custom_photo',
                'personaliza_foto.mensaje AS custom_mensaje',
                'personaliza_foto.comentarios AS custom_comentarios',
            ])
            ->join('INNER JOIN', 'producto_pedido', 'producto_pedido.pedido_id = pedido.id')
            ->join('INNER JOIN', 'producto', 'producto.id = producto_pedido.producto_id')
            ->join('INNER JOIN', 'precio', 'producto.id = precio.producto_id')
            ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
            ->join('INNER JOIN', 'talla', 'talla.id = producto_pedido.talla_id')
            ->join('LEFT JOIN', 'personaliza_foto', 'personaliza_foto.id = producto_pedido.personaliza_foto_id')
            ->where('pedido.id ='.$pedido)
            ->all();
        }
        foreach ($productos as $producto) {
            $foto = Foto::find()->where('producto_id = '.$producto->producto)->one();
            $producto->foto = $foto->archivo;
        }

        return $productos;
    }

    public function datosPedido($id){
        return $this->find()
            ->select([
                'pedido.id AS id',
                'pedido.numero_pedido AS numero_pedido',
                'pedido.created_at',
                'pedido.cliente_id AS cliente',
                'pedido.cupon_id AS id_cupon',
                'envia_ya.proveedor AS proveedor_envio',
                'envia_ya.servicio AS servicio_envio',
                'envia_ya.costo AS costo_envio',
                'estado_pedido.nombre AS estado',
                'pedido.costo_envios AS costo_envios'
            ])
            ->join('LEFT JOIN', 'envia_ya', 'envia_ya.pedido_id = pedido.id')
            ->join('INNER JOIN', 'estado_pedido', 'estado_pedido.id = pedido.estado_pedido_id')
            ->where('pedido.id = '.$id)
            ->one();
    }

    public function obtenerNumero(){
        do{
            $numero = $this->randomString(8);
            $existente = $this->find()->where('numero_pedido="'.$numero.'"')->one();
            if(!$existente)
                return $numero;
        }while(true);
    }

    private function randomString($length){
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
        $string = '';
        $max = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
             $string .= $chars[rand(0, $max)];
        }
        return $string;
    }

    public function getPaymentMethod() {
        if(isset($this->cargoOpenpays)) {
            return 'Tarjeta Bancaria';
        } else if(isset($this->paypals)){
            if($this->paypals[0]->status == 'COM') {
                return 'Paypal';
            }
        } else {
            return 'Efectivo';
        }
    }
}
