<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido_envio".
 *
 * @property int $id
 * @property int $pedido_id
 * @property int $tipo_envio_id
 * @property double $costo
 *
 * @property Pedido $pedido
 * @property TipoEnvio $tipoEnvio
 */
class PedidoEnvio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido_envio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pedido_id', 'costo'], 'required'],
            [['pedido_id', 'tipo_envio_id'], 'integer'],
            [['costo'], 'number'],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['pedido_id' => 'id']],
            [['tipo_envio_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoEnvio::className(), 'targetAttribute' => ['tipo_envio_id' => 'id']],
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
            'tipo_envio_id' => 'Tipo Envio ID',
            'costo' => 'Costo',
        ];
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
    public function getTipoEnvio()
    {
        return $this->hasOne(TipoEnvio::className(), ['id' => 'tipo_envio_id']);
    }
}
