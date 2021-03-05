<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sold_correo_talla_producto".
 *
 * @property int $sold_correo_id
 * @property int $talla_producto_id
 *
 * @property SoldCorreo $soldCorreo
 * @property TallaProducto $tallaProducto
 */
class SoldCorreoTallaProducto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sold_correo_talla_producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sold_correo_id', 'talla_producto_id'], 'required'],
            [['sold_correo_id', 'talla_producto_id'], 'integer'],
            [['sold_correo_id', 'talla_producto_id'], 'unique', 'targetAttribute' => ['sold_correo_id', 'talla_producto_id']],
            [['sold_correo_id'], 'exist', 'skipOnError' => true, 'targetClass' => SoldCorreo::className(), 'targetAttribute' => ['sold_correo_id' => 'id']],
            [['talla_producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => TallaProducto::className(), 'targetAttribute' => ['talla_producto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sold_correo_id' => 'Sold Correo ID',
            'talla_producto_id' => 'Talla Producto ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoldCorreo()
    {
        return $this->hasOne(SoldCorreo::className(), ['id' => 'sold_correo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTallaProducto()
    {
        return $this->hasOne(TallaProducto::className(), ['id' => 'talla_producto_id']);
    }
}
