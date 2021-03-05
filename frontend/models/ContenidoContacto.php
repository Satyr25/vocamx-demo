<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contenido_contacto".
 *
 * @property int $id
 * @property string $bloque1_titulo
 * @property string $bloque1_texto
 * @property string $bloque2_titulo
 * @property string $bloque2_texto
 * @property string $imagen1
 * @property string $correo
 */
class ContenidoContacto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contenido_contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bloque1_texto', 'bloque2_texto'], 'string'],
            [['bloque1_titulo', 'bloque2_titulo', 'imagen1', 'correo'], 'string', 'max' => 255],
            [['telefono'], 'string', 'max' => 10]
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
            'imagen1' => 'Imagen1',
            'correo' => 'Correo',
        ];
    }
    public function search($params){
        $query = ContenidoContacto::find()
            ->select([
                'contenido_contacto.*',
            ])
            ->one();
        return $query;
    }
}
