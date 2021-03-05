<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plantilla_filtro".
 *
 * @property int $plantilla_id
 * @property int $filtro_id
 *
 * @property Filtro $filtro
 * @property Plantilla $plantilla
 */
class PlantillaFiltro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plantilla_filtro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plantilla_id', 'filtro_id'], 'required'],
            [['plantilla_id', 'filtro_id'], 'integer'],
            [['plantilla_id', 'filtro_id'], 'unique', 'targetAttribute' => ['plantilla_id', 'filtro_id']],
            [['filtro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Filtro::className(), 'targetAttribute' => ['filtro_id' => 'id']],
            [['plantilla_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plantilla::className(), 'targetAttribute' => ['plantilla_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'plantilla_id' => 'Plantilla ID',
            'filtro_id' => 'Filtro ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiltro()
    {
        return $this->hasOne(Filtro::className(), ['id' => 'filtro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlantilla()
    {
        return $this->hasOne(Plantilla::className(), ['id' => 'plantilla_id']);
    }
}
