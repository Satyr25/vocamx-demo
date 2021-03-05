<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "filtro".
 *
 * @property int $id
 * @property string $filtro
 * @property string $clave
 *
 * @property PlantillaFiltro[] $plantillaFiltros
 * @property Plantilla[] $plantillas
 */
class Filtro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'filtro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filtro', 'clave'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filtro' => 'Filtro',
            'clave' => 'Clave',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlantillaFiltros()
    {
        return $this->hasMany(PlantillaFiltro::className(), ['filtro_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlantillas()
    {
        return $this->hasMany(Plantilla::className(), ['id' => 'plantilla_id'])->viaTable('plantilla_filtro', ['filtro_id' => 'id']);
    }
}
