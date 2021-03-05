<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "foto_color".
 *
 * @property int $id
 * @property string $archivo
 * @property int $color_decoracion_id
 * @property int $producto_id
 *
 * @property ColorDecoracion $colorDecoracion
 * @property Producto $producto
 */
class FotoColor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'foto_color';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['archivo', 'color_decoracion_id', 'producto_id'], 'required'],
            [['color_decoracion_id', 'producto_id'], 'integer'],
            [['archivo'], 'string', 'max' => 512],
            [['color_decoracion_id'], 'exist', 'skipOnError' => true, 'targetClass' => ColorDecoracion::className(), 'targetAttribute' => ['color_decoracion_id' => 'id']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['producto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'archivo' => 'Archivo',
            'color_decoracion_id' => 'Color Decoracion ID',
            'producto_id' => 'Producto ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColorDecoracion()
    {
        return $this->hasOne(ColorDecoracion::className(), ['id' => 'color_decoracion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'producto_id']);
    }
}
