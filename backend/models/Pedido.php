<?php

namespace app\models;

use Yii;
use app\models\ProductoPedido;
use app\models\PagoTienda;

/**
 * This is the model class for table "pedido".
 *
 * @property int $id
 * @property int $estado_pedido_id
 * @property int $cliente_id
 * @property int $datos_pago_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property EnviaYa[] $enviaYas
 * @property Cliente $cliente
 * @property DatosPago $datosPago
 * @property EstadoPedido $estadoPedido
 * @property PedidoEnvio[] $pedidoEnvios
 * @property ProductoPedido[] $productoPedidos
 */
class Pedido extends \yii\db\ActiveRecord
{
    public $fecha;
    public $cliente;
    public $proveedor_envio;
    public $costo_envio;
    public $servicio_envio;
    public $estado;
    public $estado_clave;
    public $ficha_url;
    public $producto_pedido;
    public $categoria;
    public $producto;
    public $nombre;
    public $talla;
    public $talla_id;
    public $total;
    public $cantidad;
    public $diseno;
    public $linea1;
    public $linea2;
    public $linea3;
    public $imagen_personalizada;
    public $label_envio;
    public $comentarios;
    public $foto_id;
    public $telefono;
    public $rastreo;
    public $entrega;
    public $precio;
    public $precio_descuento;
    public $cupon;
    public $checkouts;
    public $custom_mensaje;
    public $custom_comentarios;

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
            [['numero_pedido'], 'string'],
            [['estado_pedido_id', 'cliente_id', 'created_at', 'updated_at'], 'required'],
            [['estado_pedido_id', 'cliente_id', 'datos_pago_id', 'created_at', 'updated_at'], 'integer'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['datos_pago_id'], 'exist', 'skipOnError' => true, 'targetClass' => DatosPago::className(), 'targetAttribute' => ['datos_pago_id' => 'id']],
            [['estado_pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoPedido::className(), 'targetAttribute' => ['estado_pedido_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estado_pedido_id' => 'Estado Pedido ID',
            'cliente_id' => 'Cliente ID',
            'datos_pago_id' => 'Datos Pago ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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

    public function total(){
        $total = ProductoPedido::find()
            ->select(['SUM(producto_pedido.total) AS total'])
            ->where('pedido_id='.$this->id)
            ->one();
        return $total->total;
    }

    public function cantidadProductos(){
        $cantidad = ProductoPedido::find()
            ->select(['SUM(producto_pedido.cantidad) AS cantidad'])
            ->where('pedido_id='.$this->id)
            ->andWhere(['<>','producto_id', '112'])
            ->one();
        return $cantidad->cantidad;
    }

    public function datosPedido($id){
        return $this->find()
            ->select([
                'pedido.numero_pedido AS numero_pedido',
                'pedido.id AS id',
                'pedido.created_at',
                'pedido.cliente_id AS cliente',
                'pedido.cupon_id AS cupon',
                'pedido.costo_envios AS costo_envios',
                'envia_ya.proveedor AS proveedor_envio',
                'envia_ya.servicio AS servicio_envio',
                'envia_ya.costo AS costo_envio',
                'estado_pedido.nombre AS estado',
                'estado_pedido.clave AS estado_clave',
                'envia_ya.label AS label_envio',
                'envia_ya.rastreo_carrier AS rastreo',
                'envia_ya.entrega_estimada AS entrega',
                'pago_tienda.recibo AS ficha_url',
            ])
            ->join('LEFT JOIN', 'envia_ya', 'envia_ya.pedido_id = pedido.id')
            ->join('LEFT JOIN', 'estado_pedido', 'estado_pedido.id = pedido.estado_pedido_id')
            ->join('LEFT JOIN', 'pago_tienda', 'pedido.id = pago_tienda.pedido_id')
            ->where('pedido.id = '.$id)
            ->one();
    }

    public function productos($pedido){
        $productos = $this->find()
        ->select([
            'producto_pedido.id AS producto_pedido',
            'producto_pedido.comentarios AS comentarios',
            'producto_pedido.personaliza_foto_id AS foto_id',
            'categoria.nombre AS categoria',
            'producto.id AS producto',
            'producto.nombre AS nombre',
            'talla.talla AS talla',
            'talla.id AS talla_id',
            'producto_pedido.cantidad AS cantidad',
            'producto_pedido.total AS total',
            'producto_pedido.diseno AS diseno',
            'producto_pedido.linea1 AS linea1',
            'producto_pedido.linea2 AS linea2',
            'producto_pedido.linea3 AS linea3',
            'producto_pedido.imagen_personalizada AS imagen_personalizada',
            'producto_pedido.color_decoracion AS color_decoracion',
            'producto_pedido.medidas_decoracion AS medidas_decoracion',
            'producto_pedido.costo_decoracion AS costo_decoracion',
            'precio.precio AS precio',
            'precio.precio_descuento as precio_descuento',
            'personaliza_foto.mensaje as custom_mensaje',
            'personaliza_foto.comentarios as custom_comentarios',
        ])
        ->join('LEFT JOIN', 'producto_pedido', 'producto_pedido.pedido_id = pedido.id')
        ->join('LEFT JOIN', 'producto', 'producto.id = producto_pedido.producto_id')
        ->join('LEFT JOIN', 'precio', 'precio.id = producto_pedido.producto_id')
        ->join('LEFT JOIN', 'categoria', 'categoria.id = producto.categoria_id')
        ->join('LEFT JOIN', 'talla', 'talla.id = producto_pedido.talla_id')
        ->join('LEFT JOIN', 'personaliza_foto', 'personaliza_foto.id = producto_pedido.personaliza_foto_id')
        ->where('pedido.id ='.$pedido)
        ->all();
        return $productos;
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
