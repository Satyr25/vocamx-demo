<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "envia_ya".
 *
 * @property int $id
 * @property int $pedido_id
 * @property int $rate_id
 * @property int $shipment_id
 * @property string $servicio
 * @property double $costo
 *
 * @property Pedido $pedido
 */
class EnviaYa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'envia_ya';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pedido_id', 'rate_id', 'shipment_id', 'costo', 'proveedor'], 'required'],
            [['pedido_id', 'rate_id', 'shipment_id'], 'integer'],
            [['costo'], 'number'],
            [['entrega_estimada'], 'string'],
            [['rastreo_enviaya', 'rastreo_carrier', 'label'], 'string'],
            [['servicio', 'proveedor','carrier_service_code'], 'string', 'max' => 45],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['pedido_id' => 'id']],
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
            'rate_id' => 'Rate ID',
            'shipment_id' => 'Shipment ID',
            'servicio' => 'Servicio',
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
}
