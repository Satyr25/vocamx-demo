<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\ContenidoHeader;
use yii\helpers\Url;

/**
 * ContactForm is the model behind the contact form.
 */
class ContenidoHeaderForm extends Model
{
     public $id;
    public $head_imagen1;
    public $head_imagen2;
    public $head_texto1;
    public $head_texto2;
    public $head_texto2_1;
    public $head_texto2_2;
    public $head_texto2_3;
    public $head_texto2_4;
    public $head_texto2_5;
    public $head_texto3;
    public $head_texto4;
    public $head_texto5;
    public $foot_imagen1;
    public $foot_imagen2;
    public $foot_imagen3;
    public $foot_imagen4;
    public $foot_texto1;
    public $foot_texto2;
    public $foot_texto3;
    public $foot_texto4;
    public $foot_texto5;
    public $foot_texto6;
    public $foot_texto7;
    public $header_texto1;
    public $header_texto2;
    public $header_imagen1;
    public $header_imagen2;
    public $header_imagen3;
    public $header_imagen4;
    public $header_imagen5;
    public $header_imagen6;
    public $header_imagen7;
    public $header2_texto1;
    public $header2_imagen1;
    public $head_enlace1;
    public $head_enlace2;
    public $head_enlace3;
    public $head_enlace4;
    public $head_enlace5;
    public $head_enlace6;
    public $head_enlace7;
    public $head_enlace8;
    public $head_enlace9;
    public $head_enlace10;
    public $head_enlace11;
    public $head_enlace12;
    public $head_enlace13;
    public $head_enlace14;
    public $head_enlace15;
    public $head_enlace16;
    public $head_enlace17;
    public $head_enlace18;

     private $imagen;
     private $transaction;

    /*
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['head_texto1', 'head_texto2', 'head_texto2_1', 'head_texto2_2', 'head_texto2_3', 'head_texto2_4', 'head_texto2_5', 'head_texto3', 'head_texto4', 'head_texto5', 'foot_texto1', 'foot_texto2', 'foot_texto3', 'foot_texto4', 'foot_texto5', 'foot_texto6', 'foot_texto7', 'header_texto1', 'header_texto2', 'header2_texto1', 'head_enlace1', 'head_enlace2', 'head_enlace3', 'head_enlace4', 'head_enlace5', 'head_enlace6', 'head_enlace7', 'head_enlace8', 'head_enlace9', 'head_enlace10', 'head_enlace11', 'head_enlace12', 'head_enlace13', 'head_enlace14', 'head_enlace15', 'head_enlace16', 'head_enlace17', 'head_enlace18' ], 'string'],
            [['id'], 'integer'],
            [['head_imagen1', 'head_imagen2', 'foot_imagen1', 'foot_imagen2', 'foot_imagen3', 'foot_imagen4', 'foot_imagen5', 'foot_imagen6', 'foot_imagen7', 'header_imagen1', 'header_imagen2', 'header_imagen3', 'header_imagen4', 'header_imagen5', 'header_imagen6', 'header_imagen7', 'header2_imagen1'],'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    public function actualizar(){
        $connection = \Yii::$app->db;
        $this->transaction = $connection->beginTransaction();
        $contenido = ContenidoHeader::find()->one();
        if(!$contenido){
            $contenido = new ContenidoHeader();
        }
        $contenido->head_texto1 = $this->head_texto1;
        $contenido->head_texto2 = $this->head_texto2;
        $contenido->head_texto2_1 = $this->head_texto2_1;
        $contenido->head_texto2_2 = $this->head_texto2_2;
        $contenido->head_texto2_3 = $this->head_texto2_3;
        $contenido->head_texto2_4 = $this->head_texto2_4;
        $contenido->head_texto2_5 = $this->head_texto2_5;
        $contenido->head_texto3 = $this->head_texto3;
        $contenido->head_texto4 = $this->head_texto4;
        $contenido->head_texto5 = $this->head_texto5;
        $contenido->foot_texto1 = $this->foot_texto1;
        $contenido->foot_texto2 = $this->foot_texto2;
        $contenido->foot_texto3 = $this->foot_texto3;
        $contenido->foot_texto4 = $this->foot_texto4;
        $contenido->foot_texto5 = $this->foot_texto5;
        $contenido->foot_texto6 = $this->foot_texto6;
        $contenido->foot_texto7 = $this->foot_texto7;
        $contenido->header_texto1 = $this->header_texto1;
        $contenido->header_texto2 = $this->header_texto2;
        $contenido->header2_texto1 = $this->header2_texto1;
        $contenido->head_enlace1 = $this->head_enlace1;
        $contenido->head_enlace2 = $this->head_enlace2;
        $contenido->head_enlace3 = $this->head_enlace3;
        $contenido->head_enlace4 = $this->head_enlace4;
        $contenido->head_enlace5 = $this->head_enlace5;
        $contenido->head_enlace6 = $this->head_enlace6;
        $contenido->head_enlace7 = $this->head_enlace7;
        $contenido->head_enlace8 = $this->head_enlace8;
        $contenido->head_enlace9 = $this->head_enlace9;
        $contenido->head_enlace10 = $this->head_enlace10;
        $contenido->head_enlace11 = $this->head_enlace11;
        $contenido->head_enlace12 = $this->head_enlace12;
        $contenido->head_enlace13 = $this->head_enlace13;
        $contenido->head_enlace14 = $this->head_enlace14;
        $contenido->head_enlace15 = $this->head_enlace15;
        $contenido->head_enlace16 = $this->head_enlace16;
        $contenido->head_enlace17 = $this->head_enlace17;
        $contenido->head_enlace18 = $this->head_enlace18;

        $ruta1 = $this->guardaImagenes('head_imagen1');
        if($ruta1){
            $contenido->head_imagen1 = $ruta1;
        }
        $ruta2 = $this->guardaImagenes('head_imagen2');
        if($ruta2){
            $contenido->head_imagen2 = $ruta2;
        }
        $ruta3 = $this->guardaImagenes('foot_imagen1');
        if($ruta3){
            $contenido->foot_imagen1 = $ruta3;
        }
        $ruta4 = $this->guardaImagenes('foot_imagen2');
        if($ruta4){
            $contenido->foot_imagen2 = $ruta4;
        }
        $ruta5 = $this->guardaImagenes('foot_imagen3');
        if($ruta5){
            $contenido->foot_imagen3 = $ruta5;
        }
        $ruta6 = $this->guardaImagenes('foot_imagen4');
        if($ruta6){
            $contenido->foot_imagen4 = $ruta6;
        }
        $ruta7 = $this->guardaImagenes('header_imagen1');
        if($ruta7){
            $contenido->header_imagen1 = $ruta7;
        }
        $ruta8 = $this->guardaImagenes('header_imagen2');
        if($ruta8){
            $contenido->header_imagen2 = $ruta8;
        }
        $ruta9 = $this->guardaImagenes('header_imagen3');
        if($ruta9){
            $contenido->header_imagen3 = $ruta9;
        }
        $ruta10 = $this->guardaImagenes('header_imagen4');
        if($ruta10){
            $contenido->header_imagen4 = $ruta10;
        }
        $ruta11 = $this->guardaImagenes('header_imagen5');
        if($ruta11){
            $contenido->header_imagen5 = $ruta11;
        }
        $ruta12 = $this->guardaImagenes('header_imagen6');
        if($ruta12){
            $contenido->header_imagen6 = $ruta12;
        }
        $ruta13 = $this->guardaImagenes('header_imagen7');
        if($ruta13){
            $contenido->header_imagen7 = $ruta13;
        }
        $ruta14 = $this->guardaImagenes('header2_imagen1');
        if($ruta14){
            $contenido->header2_imagen1 = $ruta14;
        }

        if (!$contenido->save()) {
            var_dump($contenido->getErrors()    );exit;
            $this->transaction->rollback();
            return false;
        }

        $this->transaction->commit();
        return true;
    }


    public function guardaImagenes($imagen){
        if (!UploadedFile::getInstance($this, $imagen)){
            return null;
        }
        $this->imagen = UploadedFile::getInstance($this, $imagen);
        $ruta = Yii::getAlias('@backend/web/').preg_replace("/[^a-z0-9\.]/", "", "images");
        $ruta_frontend = Yii::getAlias('@frontend/web/').preg_replace("/[^a-z0-9\.]/", "", "images");
        if(!file_exists($ruta)){
            if(!mkdir($ruta)){
                return false;
            }
        }
        if(!file_exists($ruta_frontend)){
            if(!mkdir($ruta_frontend)){
                return false;
            }
        }
        $guardado = false;
        while(!$guardado){
            $timestamp = time();
            $nombre_archivo = $timestamp.preg_replace("/[^a-z0-9\.]/", "", strtolower($this->imagen));
            if(!file_exists($ruta.'/'.$nombre_archivo)){
                if(!$this->imagen->saveAs($ruta.'/'.$nombre_archivo, false )){
                    return false;
                }
                if(!$this->imagen->saveAs($ruta_frontend.'/'.$nombre_archivo, false )){
                    return false;
                }
             $guardado = true;
             }
        }
        $ruta_bd = Url::base(true).'/images/'.preg_replace("/[^a-z0-9\.]/", "", strtolower($nombre_archivo));
        return $ruta_bd;
    }
}
