<?php

namespace app\models;

use Yii;
use app\models\Categoria;
use app\models\Foto;
use app\models\Precio;
use app\models\Tipo;
use app\models\productoForm;

/**
 * This is the model class for table "producto".
 *
 * @property int $id
 * @property int $categoria_id
 * @property int $sexo_id
 * @property string $nombre
 * @property string $descripcion
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 *
 * @property ColorProducto[] $colorProductos
 * @property Foto[] $fotos
 * @property Precio[] $precios
 * @property Categoria $categoria
 * @property Sexo $sexo
 * @property ProductoCarrito[] $productoCarritos
 * @property ProductoPedido[] $productoPedidos
 * @property TallaProducto[] $tallaProductos
 */
class Producto extends \yii\db\ActiveRecord
{

    public $categoria;
    public $clave_categoria;
    public $precio;
    public $talla;
    public $talla_id;
    public $talla_nombre;
    public $foto;
    public $sexo;
    public $precio_descuento;
    public $moneda;
    public $precio_usd;
    public $precio_descuento_usd;
    public $sold;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoria_id', 'sexo_id', 'nombre', 'created_at', 'updated_at'], 'required'],
            [['categoria_id', 'sexo_id', 'created_at', 'updated_at', 'status', 'must_have'], 'integer'],
            [['descripcion'], 'string'],
            [['id_facebook'], 'string'],
            [['descripcion_breve'], 'string', 'max' => 512],
            [['nombre'], 'string', 'max' => 256],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'id']],
            [['sexo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sexo::className(), 'targetAttribute' => ['sexo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoria_id' => 'Categoria ID',
            'sexo_id' => 'Sexo ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColorProductos()
    {
        return $this->hasMany(ColorProducto::className(), ['producto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFotos()
    {
        return $this->hasMany(Foto::className(), ['producto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecios()
    {
        return $this->hasMany(Precio::className(), ['producto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexo()
    {
        return $this->hasOne(Sexo::className(), ['id' => 'sexo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoCarritos()
    {
        return $this->hasMany(ProductoCarrito::className(), ['producto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoPedidos()
    {
        return $this->hasMany(ProductoPedido::className(), ['producto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTallaProductos()
    {
        return $this->hasMany(TallaProducto::className(), ['producto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['producto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewsActivas()
    {
        return $this->hasMany(Review::className(), ['producto_id' => 'id'])->onCondition(['status' => '1']);
    }

    public function linea(){
        $productos = $this->find()
            ->select([
                'producto.id', 'producto.nombre AS nombre',
                'producto.descripcion AS descripcion', 'precio.precio AS precio'
            ])
            ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
            ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
            ->where('categoria.clave="LINE" AND producto.status=1')
            ->all();
        $productos_foto = Array();
        foreach($productos as $producto){
            $foto = Foto::find()->where('producto_id = '.$producto->id)->one();
            $datos_producto = [
                'foto' => $foto->archivo,
                'nombre' => $producto->nombre,
                'descripcion' => $producto->descripcion,
                'precio' => $producto->precio,
                'precio_descuento' => $producto->precio_descuento
            ];

            $productos_foto[$producto->id] = $datos_producto;
        }
        return $productos_foto;
    }

    public function datos($id){
        $ip = Yii::$app->geoip->ip();
        if( $ip->country !== 'Mexico'){
            $moneda = ' USD';
            $query = $this->find()
                ->select([
                    'producto.*', 'categoria.nombre AS categoria', 'categoria.clave AS clave_categoria',
                    'precio.precio_usd AS precio',
                    'precio.precio_descuento_usd AS precio_descuento'
                ])
                ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
                ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
                ->where('producto.id='.$id)
                ->one();
        } else {
            $moneda = ' MXN';
            $query = $this->find()
                ->select([
                    'producto.*', 'categoria.nombre AS categoria', 'categoria.clave AS clave_categoria',
                    'precio.precio AS precio',
                    'precio.precio_descuento AS precio_descuento'
                ])
                ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
                ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
                ->where('producto.id='.$id)
                ->one();
        }
        $query['moneda'] = $moneda;
        return $query;
    }

    public function tallas($id){
        return $this->find()
            ->select([
                'talla_producto.sold AS sold',
                'talla.id AS talla_id',
                'talla.talla AS talla',
                'talla.nombre AS talla_nombre'
            ])
            ->join('INNER JOIN', 'talla_producto', 'talla_producto.producto_id = producto.id')
            ->join('INNER JOIN', 'talla', 'talla.id = talla_producto.talla_id')
            ->where('producto.id='.$id)
            ->all();
    }
    public function tallasSold($id){
        return $this->find()
            ->select([
                'talla.id AS talla_id',
                'talla.talla AS talla',
                'talla.nombre AS talla_nombre'
            ])
            ->join('INNER JOIN', 'talla_producto', 'talla_producto.producto_id = producto.id')
            ->join('INNER JOIN', 'talla', 'talla.id = talla_producto.talla_id')
            ->where('producto.id='.$id )
            ->andwhere('talla_producto.sold = 0')
            ->all();
    }

    public function fotos($id){
        $fotos = Yii::$app->db->createCommand(
            "(SELECT ".
            "foto.archivo AS foto, NULL AS color ".
            "FROM producto ".
            "INNER JOIN foto ON foto.producto_id = producto.id ".
            "WHERE ".
            "producto.id = ".$id.")".
            "UNION ".
            "(SELECT ".
            "foto_color.archivo AS foto_color, foto_color.color_decoracion_id AS color ".
            "FROM producto ".
            "INNER JOIN foto_color ON foto_color.producto_id = producto.id ".
            "WHERE ".
            "producto.id = ".$id.")"
            )->queryAll();
        return $fotos;
    }

    public function coleccion($clave, $filterBy = false){

        $ip = Yii::$app->geoip->ip();
        if( $ip->country !== 'Mexico'){
            $moneda = ' USD';
            $query = $this->find()
                ->select([
                    'producto.id',
                    'producto.nombre AS nombre',
                    'producto.descripcion AS descripcion',
                    'producto.descripcion_breve AS descripcion_breve',
                    'producto.orden',
                    'precio.precio_usd AS precio',
                    'precio.precio_descuento_usd AS precio_descuento'
                ])
                ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
                ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
                ->where([
                    'categoria.clave' => $clave,
                    'producto.status' => 1,
                ])
                ->orderBy(['producto.orden' => SORT_ASC]);
        } else {
            $moneda = ' MXN';
            $query = $this->find()
                ->select([
                    'producto.id',
                    'producto.nombre AS nombre',
                    'producto.descripcion AS descripcion',
                    'producto.descripcion_breve AS descripcion_breve',
                    'producto.orden',
                    'precio.precio AS precio',
                    'precio.precio_descuento AS precio_descuento'
                ])
                ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
                ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
                ->where([
                    'categoria.clave' => $clave,
                    'producto.status' => 1,
                ])
                ->orderBy(['producto.orden' => SORT_ASC]);
        }
        if($filterBy){
            $tipo = Tipo::find()->where(['clave' => $filterBy])->one();
            $query = $query->join('INNER JOIN', 'producto_tipo', 'producto_tipo.producto_id = producto.id')
                ->andWhere(['producto_tipo.tipo_id' => $tipo->id]);
        }
        $productos = $query->all();
        $productos_foto = Array();
        foreach($productos as $producto){
            $foto = Foto::find()->where('producto_id = '.$producto->id)->one();
            $datos_producto = [
                'id' => $producto->id,
                'foto' => $foto->archivo,
                'nombre' => $producto->nombre,
                'descripcion' => $producto->descripcion,
                'descripcion_breve' => $producto->descripcion_breve,
                'precio' => $producto->precio,
                'precio_descuento' => $producto->precio_descuento,
                'moneda' => $moneda
            ];

            $productos_foto[$producto->id] = $datos_producto;
        }
        return $productos_foto;
    }

    public function mustHave(){
        $ip = Yii::$app->geoip->ip();
        if( $ip->country !== 'Mexico'){
            $moneda = ' USD';
            $productos = $this->find()
                ->select([
                    'producto.id', 'producto.nombre AS nombre',
                    'producto.descripcion AS descripcion',
                    'producto.descripcion_breve AS descripcion_breve',
                    'precio.precio_usd AS precio',
                    'precio.precio_descuento_usd AS precio_descuento'
                ])
                ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
                ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
                ->where('producto.must_have=1 AND producto.status != 0')
                ->all();
        } else {
            $moneda = ' MXN';
            $productos = $this->find()
                ->select([
                    'producto.id', 'producto.nombre AS nombre',
                    'producto.descripcion AS descripcion',
                    'producto.descripcion_breve AS descripcion_breve',
                    'precio.precio AS precio',
                    'precio.precio_descuento AS precio_descuento'
                ])
                ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
                ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
                ->where('producto.must_have=1 AND producto.status != 0')
                ->all();
        }
        $productos_foto = Array();
        foreach($productos as $producto){
            $foto = Foto::find()->where('producto_id = '.$producto->id)->one();
            $datos_producto = [
                'id' => $producto->id,
                'foto' => $foto->archivo,
                'nombre' => $producto->nombre,
                'descripcion' => $producto->descripcion,
                'descripcion_breve' => $producto->descripcion_breve,
                'precio' => $producto->precio,
                'precio_descuento' => $producto->precio_descuento,
                'moneda' => $moneda
            ];

            $productos_foto[$producto->id] = $datos_producto;
        }
        return $productos_foto;
    }

    public function personalizada(){
        $ip = Yii::$app->geoip->ip();
        if( $ip->country !== 'Mexico'){
            $moneda = ' USD';
            $categoria = Categoria::find()->where('clave="PERS"')->one();
            $query = $this->find()
                ->select([
                    'producto.*', 'categoria.nombre AS categoria',
                    'precio.precio_usd AS precio',
                    'precio.precio_descuento_usd AS precio_descuento'
                ])
                ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
                ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
                ->where('producto.categoria_id='.$categoria->id)
                ->one();
            $query['moneda'] = $moneda;
            return $query;
        } else {
            $moneda = ' MXN';
            $categoria = Categoria::find()->where('clave="PERS"')->one();
            $query = $this->find()
                ->select([
                    'producto.*', 'categoria.nombre AS categoria',
                    'precio.precio AS precio',
                    'precio.precio_descuento AS precio_descuento'
                ])
                ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
                ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
                ->where('producto.categoria_id='.$categoria->id)
                ->one();
            $query['moneda'] = $moneda;
            return $query;
        }
    }

    public function personalizadaFoto($elementos){
        $categoria = Categoria::find()->where('clave="TRAZ"')->one();
        return $this->find()
            ->select([
                'producto.*', 'categoria.nombre AS categoria',
                'precio.precio AS precio',
                'precio.precio_descuento AS precio_descuento'
            ])
            ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
            ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
            ->where(['categoria_id' => $categoria->id, 'elementos' => $elementos])
            ->one();
    }

    public function altaPersonalizacion(){
        $categoria = Categoria::find()->where('clave="ALPR"')->one();
        return $this->find()
            ->select([
                'producto.*', 'categoria.nombre AS categoria',
                'precio.precio AS precio',
                'precio.precio_descuento AS precio_descuento'
            ])
            ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
            ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
            ->where('producto.categoria_id='.$categoria->id)
            ->one();
    }

}
