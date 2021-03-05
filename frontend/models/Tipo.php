<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo".
 *
 * @property int $id
 * @property string $nombre
 * @property string $clave
 *
 * @property ProductoTipo[] $productoTipos
 * @property Producto[] $productos
 */
class Tipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'clave'], 'required'],
            [['nombre', 'clave'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'clave' => 'Clave',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoTipos()
    {
        return $this->hasMany(ProductoTipo::className(), ['tipo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['id' => 'producto_id'])->viaTable('producto_tipo', ['tipo_id' => 'id']);
    }
}
