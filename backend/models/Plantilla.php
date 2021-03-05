<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plantilla".
 *
 * @property int $id
 * @property string $nombre
 * @property string $css_id
 *
 * @property PlantillaFiltro[] $plantillaFiltros
 * @property Filtro[] $filtros
 */
class Plantilla extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plantilla';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'css_id'], 'string', 'max' => 45],
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
            'css_id' => 'Css ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlantillaFiltros()
    {
        return $this->hasMany(PlantillaFiltro::className(), ['plantilla_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiltros()
    {
        return $this->hasMany(Filtro::className(), ['id' => 'filtro_id'])->viaTable('plantilla_filtro', ['plantilla_id' => 'id']);
    }
}
