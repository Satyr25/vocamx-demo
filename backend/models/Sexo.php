<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sexo".
 *
 * @property int $id
 * @property string $sexo
 *
 * @property Producto[] $productos
 */
class Sexo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sexo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sexo'], 'required'],
            [['sexo'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sexo' => 'Sexo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['sexo_id' => 'id']);
    }
}
