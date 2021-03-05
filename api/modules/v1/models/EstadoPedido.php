<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "estado_pedido".
 *
 * @property int $id
 * @property string $clave
 * @property string $nombre
 *
 * @property Pedido[] $pedidos
 */
class EstadoPedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado_pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'nombre'], 'required'],
            [['clave'], 'string', 'max' => 4],
            [['nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave' => 'Clave',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['estado_pedido_id' => 'id']);
    }
}
