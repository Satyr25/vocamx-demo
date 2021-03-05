<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $posicion
 * @property int $personaliza_foto_id
 *
 * @property PersonalizaFoto $personalizaFoto
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['personaliza_foto_id'], 'required'],
            [['personaliza_foto_id'], 'integer'],
            [['posicion'], 'string', 'max' => 45],
            [['personaliza_foto_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonalizaFoto::className(), 'targetAttribute' => ['personaliza_foto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'posicion' => 'Posicion',
            'personaliza_foto_id' => 'Personaliza Foto ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalizaFoto()
    {
        return $this->hasOne(PersonalizaFoto::className(), ['id' => 'personaliza_foto_id']);
    }
}
