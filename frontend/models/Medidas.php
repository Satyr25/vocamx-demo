<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medidas".
 *
 * @property int $id
 * @property string $medidas
 *
 * @property DecoracionMedidas[] $decoracionMedidas
 * @property VarianteDecoracion[] $varianteDecoracions
 */
class Medidas extends \yii\db\ActiveRecord
{
    public $precio;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medidas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['medidas'], 'required'],
            [['medidas'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'medidas' => 'Medidas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecoracionMedidas()
    {
        return $this->hasMany(DecoracionMedidas::className(), ['medidas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVarianteDecoracions()
    {
        return $this->hasMany(VarianteDecoracion::className(), ['medidas_id' => 'id']);
    }
}
