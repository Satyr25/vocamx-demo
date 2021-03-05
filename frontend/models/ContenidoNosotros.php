<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contenido_nosotros".
 *
 * @property int $id
 * @property string $bloque1_titulo
 * @property string $bloque1_texto
 * @property string $bloque2_titulo
 * @property string $bloque2_texto
 * @property string $bloque3_titulo
 * @property string $bloque3_texto
 * @property string $bloque4_titulo
 * @property string $bloque4_texto
 * @property string $bloque5_titulo
 * @property string $bloque5_texto
 * @property string $imagen1
 * @property string $logo1
 * @property string $correo1
 */
class ContenidoNosotros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contenido_nosotros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bloque1_texto', 'bloque2_texto', 'bloque3_texto', 'bloque4_texto', 'bloque5_texto'], 'string'],
            [['bloque1_titulo', 'bloque2_titulo', 'bloque3_titulo', 'bloque4_titulo', 'bloque5_titulo', 'imagen1', 'logo1', 'correo1'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bloque1_titulo' => 'Bloque1 Titulo',
            'bloque1_texto' => 'Bloque1 Texto',
            'bloque2_titulo' => 'Bloque2 Titulo',
            'bloque2_texto' => 'Bloque2 Texto',
            'bloque3_titulo' => 'Bloque3 Titulo',
            'bloque3_texto' => 'Bloque3 Texto',
            'bloque4_titulo' => 'Bloque4 Titulo',
            'bloque4_texto' => 'Bloque4 Texto',
            'bloque5_titulo' => 'Bloque5 Titulo',
            'bloque5_texto' => 'Bloque5 Texto',
            'imagen1' => 'Imagen1',
            'logo1' => 'Logo1',
            'correo1' => 'Correo1',
        ];
    }
    public function search($params){
        $query = ContenidoNosotros::find()
            ->select([
                'contenido_nosotros.*',
            ])
            ->one();
        return $query;
    }
}
