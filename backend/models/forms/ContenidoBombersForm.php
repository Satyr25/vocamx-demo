<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\ContenidoBombers;
use yii\helpers\Url;

/**
 * ContactForm is the model behind the contact form.
 */
class ContenidoBombersForm extends Model
{
     public $id;
     public $bloque1_fondo1;
     public $bloque1_imagen1;
     public $bloque1_imagen2;
     public $bloque1_titulo1;
     public $bloque1_texto1;
     public $bloque1_texto2;
     public $bloque1_texto3;
     public $bloque1_boton1;
     public $bloque1_enlace1;
     public $bloque2_fondo1;
     public $bloque2_imagen1;
     public $bloque2_imagen2;
     public $bloque2_titulo1;
     public $bloque2_texto1;
     public $bloque2_texto2;
     public $bloque2_texto3;
     public $bloque2_boton1;
     public $bloque2_enlace1;
     public $bloque3_fondo1;
     public $bloque3_imagen1;
     public $bloque3_imagen2;
     public $bloque3_titulo1;
     public $bloque3_texto1;
     public $bloque3_texto2;
     public $bloque3_texto3;
     public $bloque3_boton1;
     public $bloque3_enlace1;
     public $bloque4_imagen1;
     public $bloque4_imagen2;
     public $bloque4_imagen3;
     public $bloque4_imagen4;
     public $bloque4_imagen5;
     public $bloque4_texto1;
     public $bloque4_texto2;
     public $bloque4_texto3;
     public $bloque4_texto4;
     public $bloque4_texto5;
     public $bloque4_texto6;
     public $bloque5_titulo1;
     public $bloque6_imagen1;
     public $bloque6_imagen2;
     public $bloque6_titulo1;
     public $bloque6_texto1;
     public $bloque7_imagen1;
     public $bloque7_imagen2;
     public $bloque7_titulo1;
     public $bloque7_texto1;
     public $bloque8_imagen1;
     public $bloque8_imagen2;
     public $bloque8_titulo1;
     public $bloque8_texto1;
     public $popup1_imagen1;
     

     private $imagen;
     private $transaction;

    /*
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['bloque1_fondo1', 'bloque1_titulo1', 'bloque1_texto1', 'bloque1_texto2', 'bloque1_texto3', 'bloque1_boton1', 'bloque1_enlace1', 'bloque2_fondo1', 'bloque2_titulo1', 'bloque2_texto1', 'bloque2_texto2', 'bloque2_texto3', 'bloque2_boton1', 'bloque2_enlace1', 'bloque3_fondo1', 'bloque3_titulo1', 'bloque3_texto1', 'bloque3_texto2', 'bloque3_texto3', 'bloque3_boton1', 'bloque3_enlace1', 'bloque4_texto1', 'bloque4_texto2', 'bloque4_texto3', 'bloque4_texto4', 'bloque4_texto5', 'bloque4_texto6', 'bloque5_titulo1', 'bloque6_titulo1', 'bloque6_texto1',  'bloque7_titulo1', 'bloque7_texto1', 'bloque8_titulo1', 'bloque8_texto1', 'popup1_imagen1'], 'string'],
            [['id'], 'integer'],
            [['bloque1_imagen1', 'bloque1_imagen2', 'bloque2_imagen1', 'bloque2_imagen2', 'bloque3_imagen1', 'bloque3_imagen2', 'bloque4_imagen1', 'bloque4_imagen2', 'bloque4_imagen3', 'bloque4_imagen4', 'bloque4_imagen5', 'bloque6_imagen1', 'bloque6_imagen2','bloque7_imagen1', 'bloque7_imagen2', 'bloque8_imagen1', 'bloque8_imagen2'],'file', 'extensions' => 'png, jpg'],
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
        $contenido = ContenidoBombers::find()->one();
        if(!$contenido){
            $contenido = new ContenidoBombers();
        }
        
        $contenido->bloque1_titulo1 = $this->bloque1_titulo1;
        $contenido->bloque1_texto1 = $this->bloque1_texto1;
        $contenido->bloque1_texto2 = $this->bloque1_texto2;
        $contenido->bloque1_boton1 = $this->bloque1_boton1;
        $contenido->bloque1_enlace1 = $this->bloque1_enlace1;
        $contenido->bloque2_titulo1 = $this->bloque2_titulo1;
        $contenido->bloque2_texto1 = $this->bloque2_texto1;
        $contenido->bloque2_texto2 = $this->bloque2_texto2;
        $contenido->bloque2_boton1 = $this->bloque2_boton1;
        $contenido->bloque2_enlace1 = $this->bloque2_enlace1;
        $contenido->bloque3_titulo1 = $this->bloque3_titulo1;
        $contenido->bloque3_texto1 = $this->bloque3_texto1;
        $contenido->bloque3_texto2 = $this->bloque3_texto2;
        $contenido->bloque3_boton1 = $this->bloque3_boton1;
        $contenido->bloque3_enlace1 = $this->bloque3_enlace1;
        $contenido->bloque4_texto1 = $this->bloque4_texto1;
        $contenido->bloque4_texto2 = $this->bloque4_texto2;
        $contenido->bloque4_texto3 = $this->bloque4_texto3;
        $contenido->bloque4_texto4 = $this->bloque4_texto4;
        $contenido->bloque4_texto5 = $this->bloque4_texto5;
        $contenido->bloque4_texto6 = $this->bloque4_texto6; 
        $contenido->bloque5_titulo1 = $this->bloque5_titulo1;
        $contenido->bloque6_titulo1 = $this->bloque6_titulo1;
        $contenido->bloque6_texto1 = $this->bloque6_texto1;
        $contenido->bloque7_titulo1 = $this->bloque7_titulo1;
        $contenido->bloque7_texto1 = $this->bloque7_texto1;
        $contenido->bloque8_titulo1 = $this->bloque8_titulo1;
        $contenido->bloque8_texto1 = $this->bloque8_texto1;
        
        
        $ruta1 = $this->guardaImagenes('bloque1_imagen1');
        if($ruta1){
            $contenido->bloque1_imagen1 = $ruta1;
        }
        $ruta2 = $this->guardaImagenes('bloque1_imagen2');
        if($ruta2){
            $contenido->bloque1_imagen2 = $ruta2;
        }
        $ruta3 = $this->guardaImagenes('bloque2_imagen1');
        if($ruta3){
            $contenido->bloque2_imagen1 = $ruta3;
        }
        $ruta4 = $this->guardaImagenes('bloque2_imagen2');
        if($ruta4){
            $contenido->bloque2_imagen2 = $ruta4;
        }
        $ruta5 = $this->guardaImagenes('bloque3_imagen1');
        if($ruta5){
            $contenido->bloque3_imagen1 = $ruta5;
        }
        $ruta6 = $this->guardaImagenes('bloque3_imagen2');
        if($ruta6){
            $contenido->bloque3_imagen2 = $ruta6;
        }
        $ruta7 = $this->guardaImagenes('bloque4_imagen1');
        if($ruta7){
            $contenido->bloque4_imagen1 = $ruta7;
        }
        $ruta8 = $this->guardaImagenes('bloque4_imagen2');
        if($ruta8){
            $contenido->bloque4_imagen2 = $ruta8;
        }
        $ruta9 = $this->guardaImagenes('bloque4_imagen3');
        if($ruta9){
            $contenido->bloque4_imagen3 = $ruta9;
        }
        $ruta10 = $this->guardaImagenes('bloque4_imagen4');
        if($ruta10){
            $contenido->bloque4_imagen4 = $ruta10;
        }
        $ruta11 = $this->guardaImagenes('bloque4_imagen5');
        if($ruta11){
            $contenido->bloque4_imagen5 = $ruta11;
        }
        $ruta12 = $this->guardaImagenes('bloque6_imagen1');
        if($ruta12){
            $contenido->bloque6_imagen1 = $ruta12;
        }
        $ruta13 = $this->guardaImagenes('bloque6_imagen2');
        if($ruta13){
            $contenido->bloque6_imagen2 = $ruta13;
        }
        $ruta14 = $this->guardaImagenes('bloque7_imagen1');
        if($ruta14){
            $contenido->bloque7_imagen1 = $ruta14;
        }
        $ruta15 = $this->guardaImagenes('bloque7_imagen2');
        if($ruta15){
            $contenido->bloque7_imagen2 = $ruta15;
        }
        $ruta16 = $this->guardaImagenes('bloque8_imagen1');
        if($ruta16){
            $contenido->bloque8_imagen1 = $ruta16;
        }
        $ruta17 = $this->guardaImagenes('bloque8_imagen2');
        if($ruta17){
            $contenido->bloque8_imagen2 = $ruta17;
        }
        $ruta18 = $this->guardaImagenes('bloque1_fondo1');
        if($ruta18){
            $contenido->bloque1_fondo1 = $ruta18;
        }
        $ruta19 = $this->guardaImagenes('bloque2_fondo1');
        if($ruta19){
            $contenido->bloque2_fondo1 = $ruta19;
        }
        $ruta20 = $this->guardaImagenes('bloque3_fondo1');
        if($ruta20){
            $contenido->bloque3_fondo1 = $ruta20;
        }
        $ruta21 = $this->guardaImagenes('popup1_imagen1');
        if($ruta21){
            $contenido->popup1_imagen1 = $ruta21;
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
