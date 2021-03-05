<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "decoracion_medidas".
 *
 * @property int $id
 * @property int $medidas_id
 * @property int $producto_id
 *
 * @property Medidas $medidas
 * @property Producto $producto
 */
class DecoracionMedidas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'decoracion_medidas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['medidas_id', 'producto_id'], 'required'],
            [['medidas_id', 'producto_id'], 'integer'],
            [['medidas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medidas::className(), 'targetAttribute' => ['medidas_id' => 'id']],
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
            'medidas_id' => 'Medidas ID',
            'producto_id' => 'Producto ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedidas()
    {
        return $this->hasOne(Medidas::className(), ['id' => 'medidas_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'producto_id']);
    }
}
