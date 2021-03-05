<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contenido_garantias".
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
 * @property string $bloque5_texto2
 * @property string $bloque5_correo
 * @property string $imagen1
 * @property string $imagen2
 */
class ContenidoGarantias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contenido_garantias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bloque1_texto', 'bloque2_texto', 'bloque3_texto', 'bloque4_texto', 'bloque5_texto', 'bloque5_texto2'], 'string'],
            [['bloque1_titulo', 'bloque2_titulo', 'bloque3_titulo', 'bloque4_titulo', 'bloque5_titulo', 'bloque5_correo', 'enlace1', 'imagen1', 'imagen2'], 'string', 'max' => 255],
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
            'bloque5_texto2' => 'Bloque5 Texto2',
            'bloque5_correo' => 'Bloque5 Correo',
            'imagen1' => 'Imagen1',
            'imagen2' => 'Imagen2',
        ];
    }
    public function search($params){
        $query = ContenidoGarantias::find()
            ->select([
                'contenido_garantias.*',
            ])
            ->one();
        return $query;
    }
}
