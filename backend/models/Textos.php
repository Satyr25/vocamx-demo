<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "textos".
 *
 * @property int $id
 * @property string $texto
 * @property int $contenido_id
 *
 * @property Contenido $contenido
 */
class Textos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'textos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['texto', 'contenido_id'], 'required'],
            [['contenido_id'], 'integer'],
            [['texto'], 'string', 'max' => 255],
            [['contenido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contenido::className(), 'targetAttribute' => ['contenido_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'texto' => 'Texto',
            'contenido_id' => 'Contenido ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContenido()
    {
        return $this->hasOne(Contenido::className(), ['id' => 'contenido_id']);
    }
}
