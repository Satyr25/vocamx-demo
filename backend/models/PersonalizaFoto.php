<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personaliza_foto".
 *
 * @property int $id
 * @property int $elementos
 * @property string $comentarios
 * @property string $custom_photo
 *
 * @property ProductoCarrito[] $productoCarritos
 * @property ProductoPedido[] $productoPedidos
 */
class PersonalizaFoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personaliza_foto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['elementos', 'custom_photo'], 'required'],
            [['elementos'], 'integer'],
            [['comentarios'], 'string'],
            [['custom_photo'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'elementos' => 'Elementos',
            'comentarios' => 'Comentarios',
            'custom_photo' => 'Custom Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoCarritos()
    {
        return $this->hasMany(ProductoCarrito::className(), ['personaliza_foto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoPedidos()
    {
        return $this->hasMany(ProductoPedido::className(), ['personaliza_foto_id' => 'id']);
    }
}
