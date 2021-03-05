<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto_pedido".
 *
 * @property int $id
 * @property int $pedido_id
 * @property int $producto_id
 * @property int $talla_id
 * @property int $color_id
 * @property int $cantidad
 * @property string $total
 * @property string $diseno
 * @property string $linea1
 * @property string $linea2
 * @property string $linea3
 * @property string $imagen_personalizada
 * @property string $comentarios
 * @property int $personaliza_foto_id
 *
 * @property Color $color
 * @property Pedido $pedido
 * @property PersonalizaFoto $personalizaFoto
 * @property Producto $producto
 * @property Talla $talla
 */
class ProductoPedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto_pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pedido_id', 'producto_id', 'talla_id', 'total'], 'required'],
            [['pedido_id', 'producto_id', 'talla_id', 'color_id', 'cantidad', 'personaliza_foto_id'], 'integer'],
            [['total'], 'number'],
            [['comentarios', 'color_decoracion', 'medidas_decoracion'], 'string'],
            [['costo_decoracion'], 'double'],
            [['diseno'], 'string', 'max' => 45],
            [['linea1', 'linea2', 'linea3'], 'string', 'max' => 10],
            [['imagen_personalizada'], 'string', 'max' => 512],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['pedido_id' => 'id']],
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
            'pedido_id' => 'Pedido ID',
            'producto_id' => 'Producto ID',
            'talla_id' => 'Talla ID',
            'color_id' => 'Color ID',
            'cantidad' => 'Cantidad',
            'total' => 'Total',
            'diseno' => 'Diseno',
            'linea1' => 'Linea1',
            'linea2' => 'Linea2',
            'linea3' => 'Linea3',
            'imagen_personalizada' => 'Imagen Personalizada',
            'comentarios' => 'Comentarios',
            'personaliza_foto_id' => 'Personaliza Foto ID',
        ];
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
    public function getPedido()
    {
        return $this->hasOne(Pedido::className(), ['id' => 'pedido_id']);
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
