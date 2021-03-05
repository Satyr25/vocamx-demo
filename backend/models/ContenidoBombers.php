<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contenido_bombers".
 *
 * @property int $id
 * @property string $bloque1_fondo1
 * @property string $bloque1_imagen1
 * @property string $bloque1_imagen2
 * @property string $bloque1_titulo1
 * @property string $bloque1_texto1
 * @property string $bloque1_texto2
 * @property string $bloque1_boton1
 * @property string $bloque1_enlace1
 * @property string $bloque2_fondo1
 * @property string $bloque2_imagen1
 * @property string $bloque2_imagen2
 * @property string $bloque2_titulo1
 * @property string $bloque2_texto1
 * @property string $bloque2_texto2
 * @property string $bloque2_boton1
 * @property string $bloque2_enlace1
 * @property string $bloque3_fondo1
 * @property string $bloque3_imagen1
 * @property string $bloque3_imagen2
 * @property string $bloque3_titulo1
 * @property string $bloque3_texto1
 * @property string $bloque3_texto2
 * @property string $bloque3_boton1
 * @property string $bloque3_enlace1
 * @property string $bloque4_imagen1
 * @property string $bloque4_imagen2
 * @property string $bloque4_imagen3
 * @property string $bloque4_imagen4
 * @property string $bloque4_imagen5
 * @property string $bloque4_texto1
 * @property string $bloque4_texto2
 * @property string $bloque4_texto3
 * @property string $bloque4_texto4
 * @property string $bloque4_texto5
 * @property string $bloque4_texto6
 * @property string $bloque5_titulo1
 * @property string $bloque6_imagen1
 * @property string $bloque6_titulo1
 * @property string $bloque6_texto1
 * @property string $bloque6_imagen2
 * @property string $bloque7_imagen1
 * @property string $bloque7_titulo1
 * @property string $bloque7_texto1
 * @property string $bloque7_imagen2
 * @property string $bloque8_imagen1
 * @property string $bloque8_titulo1
 * @property string $bloque8_texto1
 * @property string $bloque8_imagen2
 */
class ContenidoBombers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contenido_bombers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bloque1_texto1', 'bloque2_texto1', 'bloque3_texto1', 'bloque4_texto1', 'bloque4_texto2', 'bloque4_texto3', 'bloque4_texto4', 'bloque6_texto1'], 'string'],
            [['bloque1_fondo1', 'bloque1_imagen1', 'bloque1_imagen2', 'bloque1_titulo1', 'bloque1_texto2', 'bloque1_boton1', 'bloque1_enlace1', 'bloque2_fondo1', 'bloque2_imagen1', 'bloque2_imagen2', 'bloque2_titulo1', 'bloque2_texto2', 'bloque2_boton1', 'bloque2_enlace1', 'bloque3_fondo1', 'bloque3_imagen1', 'bloque3_imagen2', 'bloque3_titulo1', 'bloque3_texto2', 'bloque3_boton1', 'bloque3_enlace1', 'bloque4_imagen1', 'bloque4_imagen2', 'bloque4_imagen3', 'bloque4_imagen4', 'bloque4_imagen5', 'bloque4_texto5', 'bloque4_texto6', 'bloque5_titulo1', 'bloque6_imagen1', 'bloque6_titulo1', 'bloque6_imagen2', 'bloque7_imagen1', 'bloque7_titulo1', 'bloque7_texto1', 'bloque7_imagen2', 'bloque8_imagen1', 'bloque8_titulo1', 'bloque8_texto1', 'bloque8_imagen2', 'popup1_imagen1'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bloque1_fondo1' => 'Bloque1 Fondo1',
            'bloque1_imagen1' => 'Bloque1 Imagen1',
            'bloque1_imagen2' => 'Bloque1 Imagen2',
            'bloque1_titulo1' => 'Bloque1 Titulo1',
            'bloque1_texto1' => 'Bloque1 Texto1',
            'bloque1_texto2' => 'Bloque1 Texto2',
            'bloque1_boton1' => 'Bloque1 Boton1',
            'bloque1_enlace1' => 'Bloque1 Enlace1',
            'bloque2_fondo1' => 'Bloque2 Fondo1',
            'bloque2_imagen1' => 'Bloque2 Imagen1',
            'bloque2_imagen2' => 'Bloque2 Imagen2',
            'bloque2_titulo1' => 'Bloque2 Titulo1',
            'bloque2_texto1' => 'Bloque2 Texto1',
            'bloque2_texto2' => 'Bloque2 Texto2',
            'bloque2_boton1' => 'Bloque2 Boton1',
            'bloque2_enlace1' => 'Bloque2 Enlace1',
            'bloque3_fondo1' => 'Bloque3 Fondo1',
            'bloque3_imagen1' => 'Bloque3 Imagen1',
            'bloque3_imagen2' => 'Bloque3 Imagen2',
            'bloque3_titulo1' => 'Bloque3 Titulo1',
            'bloque3_texto1' => 'Bloque3 Texto1',
            'bloque3_texto2' => 'Bloque3 Texto2',
            'bloque3_boton1' => 'Bloque3 Boton1',
            'bloque3_enlace1' => 'Bloque3 Enlace1',
            'bloque4_imagen1' => 'Bloque4 Imagen1',
            'bloque4_imagen2' => 'Bloque4 Imagen2',
            'bloque4_imagen3' => 'Bloque4 Imagen3',
            'bloque4_imagen4' => 'Bloque4 Imagen4',
            'bloque4_imagen5' => 'Bloque4 Imagen5',
            'bloque4_texto1' => 'Bloque4 Texto1',
            'bloque4_texto2' => 'Bloque4 Texto2',
            'bloque4_texto3' => 'Bloque4 Texto3',
            'bloque4_texto4' => 'Bloque4 Texto4',
            'bloque4_texto5' => 'Bloque4 Texto5',
            'bloque4_texto6' => 'Bloque4 Texto6',
            'bloque5_titulo1' => 'Bloque5 Titulo1',
            'bloque6_imagen1' => 'Bloque6 Imagen1',
            'bloque6_titulo1' => 'Bloque6 Titulo1',
            'bloque6_texto1' => 'Bloque6 Texto1',
            'bloque6_imagen2' => 'Bloque6 Imagen2',
            'bloque7_imagen1' => 'Bloque7 Imagen1',
            'bloque7_titulo1' => 'Bloque7 Titulo1',
            'bloque7_texto1' => 'Bloque7 Texto1',
            'bloque7_imagen2' => 'Bloque7 Imagen2',
            'bloque8_imagen1' => 'Bloque8 Imagen1',
            'bloque8_titulo1' => 'Bloque8 Titulo1',
            'bloque8_texto1' => 'Bloque8 Texto1',
            'bloque8_imagen2' => 'Bloque8 Imagen2',
        ];
    }
    
    public function search($params){
        $query = ContenidoBombers::find()
            ->select([
                'contenido_bombers.*',
            ])
            ->one();
        return $query;
    }
}
