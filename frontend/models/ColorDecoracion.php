<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "color_decoracion".
 *
 * @property int $id
 * @property string $color
 *
 * @property DecoracionColores[] $decoracionColores
 * @property VarianteDecoracion[] $varianteDecoracions
 */
class ColorDecoracion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'color_decoracion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color'], 'required'],
            [['color'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecoracionColores()
    {
        return $this->hasMany(DecoracionColores::className(), ['color_decoracion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVarianteDecoracions()
    {
        return $this->hasMany(VarianteDecoracion::className(), ['color_decoracion_id' => 'id']);
    }
}
