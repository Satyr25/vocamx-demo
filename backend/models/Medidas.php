<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medidas".
 *
 * @property int $id
 * @property string $medidas
 * @property double $precio
 * @property double $precio_usd
 *
 * @property DecoracionMedidas[] $decoracionMedidas
 */
class Medidas extends \yii\db\ActiveRecord
{
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
}
