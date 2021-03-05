<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto_carrito".
 *
 * @property int $id
 * @property int $carrito_id
 * @property int $talla_id
 * @property int $color_id
 * @property int $cantidad
 * @property string $diseno
 * @property string $linea1
 * @property string $linea2
 * @property string $linea3
 * @property string $imagen_personalizada
 * @property int $producto_id
 * @property string $comentarios
 * @property int $personaliza_foto_id
 *
 * @property Carrito $carrito
 * @property Color $color
 * @property PersonalizaFoto $personalizaFoto
 * @property Producto $producto
 * @property Talla $talla
 */
class ProductoCarrito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto_carrito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carrito_id', 'talla_id', 'cantidad', 'producto_id'], 'required'],
            [['carrito_id', 'talla_id', 'color_id', 'cantidad', 'producto_id', 'personaliza_foto_id'], 'integer'],
            [['imagen_personalizada', 'comentarios', 'color_decoracion', 'medidas_decoracion'], 'string'],
            [['costo_decoracion'], 'double'],
            [['diseno'], 'string', 'max' => 45],
            [['linea1', 'linea2', 'linea3'], 'string', 'max' => 10],
            [['carrito_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carrito::className(), 'targetAttribute' => ['carrito_id' => 'id']],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['color_id' => 'id']],
            [['personaliza_foto_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonalizaFoto::className(), 'targetAttribute' => ['personaliza_foto_id' => 'id']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['producto_id' => 'id']],
            [['talla_id'], 'exist', 'skipOnError' => true, 'targetClass' => Talla::className(), 'targetAttribute' => ['talla_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'carrito_id' => 'Carrito ID',
            'talla_id' => 'Talla ID',
            'color_id' => 'Color ID',
            'cantidad' => 'Cantidad',
            'diseno' => 'Diseno',
            'linea1' => 'Linea1',
            'linea2' => 'Linea2',
            'linea3' => 'Linea3',
            'imagen_personalizada' => 'Imagen Personalizada',
            'producto_id' => 'Producto ID',
            'comentarios' => 'Comentarios',
            'personaliza_foto_id' => 'Personaliza Foto ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarrito()
    {
        return $this->hasOne(Carrito::className(), ['id' => 'carrito_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Color::className(), ['id' => 'color_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalizaFoto()
    {
        return $this->hasOne(PersonalizaFoto::className(), ['id' => 'personaliza_foto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'producto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTalla()
    {
        return $this->hasOne(Talla::className(), ['id' => 'talla_id']);
    }
}
