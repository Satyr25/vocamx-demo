<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contenido".
 *
 * @property int $id
 * @property string $seccion
 * @property string $fondo
 *
 * @property Imagenes[] $imagenes
 * @property Textos[] $textos
 */
class Contenido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contenido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seccion'], 'required'],
            [['seccion'], 'string', 'max' => 45],
            [['fondo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'seccion' => 'Seccion',
            'fondo' => 'Fondo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagenes()
    {
        return $this->hasMany(Imagenes::className(), ['contenido_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTextos()
    {
        return $this->hasMany(Textos::className(), ['contenido_id' => 'id']);
    }
}
