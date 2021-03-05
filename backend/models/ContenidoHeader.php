<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contenido_header".
 *
 * @property int $id
 * @property string $head_imagen1
 * @property string $head_imagen2
 * @property string $head_texto1
 * @property string $head_texto2
 * @property string $head_texto2_1
 * @property string $head_texto2_2
 * @property string $head_texto2_3
 * @property string $head_texto2_4
 * @property string $head_texto2_5
 * @property string $head_texto3
 * @property string $head_texto4
 * @property string $head_texto5
 * @property string $foot_imagen1
 * @property string $foot_imagen2
 * @property string $foot_imagen3
 * @property string $foot_imagen4
 * @property string $foot_texto1
 * @property string $foot_texto2
 * @property string $foot_texto3
 * @property string $foot_texto4
 * @property string $foot_texto5
 * @property string $foot_texto6
 * @property string $foot_texto7
 * @property string $header_texto1
 * @property string $header_texto2
 * @property string $header_imagen1
 * @property string $header_imagen2
 * @property string $header_imagen3
 * @property string $header_imagen4
 * @property string $header_imagen5
 * @property string $header_imagen6
 * @property string $header_imagen7
 * @property string $header2_imagen1
 * @property string $header2_texto1
 */
class ContenidoHeader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contenido_header';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['foot_texto1'], 'string'],
            [['head_imagen1', 'head_imagen2', 'head_texto1', 'head_texto2', 'head_texto2_1', 'head_texto2_2', 'head_texto2_3', 'head_texto2_4', 'head_texto2_5', 'head_texto3', 'head_texto4', 'head_texto5', 'foot_imagen1', 'foot_imagen2', 'foot_imagen3', 'foot_imagen4', 'foot_texto2', 'foot_texto3', 'foot_texto4', 'foot_texto5', 'foot_texto6', 'foot_texto7', 'header_texto1', 'header_texto2', 'header_imagen1', 'header_imagen2', 'header_imagen3', 'header_imagen4', 'header_imagen5', 'header_imagen6', 'header_imagen7', 'header2_imagen1', 'header2_texto1', 'head_enlace1', 'head_enlace2', 'head_enlace3', 'head_enlace4', 'head_enlace5', 'head_enlace6', 'head_enlace7', 'head_enlace8', 'head_enlace9', 'head_enlace10', 'head_enlace11', 'head_enlace12', 'head_enlace13', 'head_enlace14', 'head_enlace15', 'head_enlace16', 'head_enlace17', 'head_enlace18'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'head_imagen1' => 'Head Imagen1',
            'head_imagen2' => 'Head Imagen2',
            'head_texto1' => 'Head Texto1',
            'head_texto2' => 'Head Texto2',
            'head_texto2_1' => 'Head Texto2 1',
            'head_texto2_2' => 'Head Texto2 2',
            'head_texto2_3' => 'Head Texto2 3',
            'head_texto2_4' => 'Head Texto2 4',
            'head_texto2_5' => 'Head Texto2 5',
            'head_texto3' => 'Head Texto3',
            'head_texto4' => 'Head Texto4',
            'head_texto5' => 'Head Texto5',
            'foot_imagen1' => 'Foot Imagen1',
            'foot_imagen2' => 'Foot Imagen2',
            'foot_imagen3' => 'Foot Imagen3',
            'foot_imagen4' => 'Foot Imagen4',
            'foot_texto1' => 'Foot Texto1',
            'foot_texto2' => 'Foot Texto2',
            'foot_texto3' => 'Foot Texto3',
            'foot_texto4' => 'Foot Texto4',
            'foot_texto5' => 'Foot Texto5',
            'foot_texto6' => 'Foot Texto6',
            'foot_texto7' => 'Foot Texto7',
            'header_texto1' => 'Header Texto1',
            'header_texto2' => 'Header Texto2',
            'header_imagen1' => 'Header Imagen1',
            'header_imagen2' => 'Header Imagen2',
            'header_imagen3' => 'Header Imagen3',
            'header_imagen4' => 'Header Imagen4',
            'header_imagen5' => 'Header Imagen5',
            'header_imagen6' => 'Header Imagen6',
            'header_imagen7' => 'Header Imagen7',
            'header2_imagen1' => 'Header2 Imagen1',
            'header2_texto1' => 'Header2 Texto1',
        ];
    }
    public function search($params){
        $query = ContenidoHeader::find()
            ->select([
                'contenido_header.*',
            ])
            ->one();
        return $query;
    }
}
