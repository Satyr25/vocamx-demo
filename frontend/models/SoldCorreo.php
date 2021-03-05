<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "sold_correo".
 *
 * @property int $id
 * @property string $correo
 * @property int $created_at
 * @property int $producto_id
 * @property int $talla_id
 *
 * @property SoldCorreoTallaProducto[] $soldCorreoTallaProductos
 * @property TallaProducto[] $tallaProductos
 */
class SoldCorreo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sold_correo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['correo', 'producto_id', 'talla_id'], 'required'],
            [['created_at', 'producto_id', 'talla_id'], 'integer'],
            [['correo'], 'string', 'max' => 45],
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
            'correo' => 'Correo',
            'created_at' => 'Created At',
            'producto_id' => 'Producto ID',
            'talla_id' => 'Talla ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoldCorreoTallaProductos()
    {
        return $this->hasMany(SoldCorreoTallaProducto::className(), ['sold_correo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTallaProductos()
    {
        return $this->hasMany(TallaProducto::className(), ['id' => 'talla_producto_id'])->viaTable('sold_correo_talla_producto', ['sold_correo_id' => 'id']);
    }
}
