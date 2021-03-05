<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\ContenidoHome;
use yii\helpers\Url;

/**
 * ContactForm is the model behind the contact form.
 */
class ContenidoForm extends Model
{
     public $id;
     public $bloque1_texto1;
     public $bloque1_texto2;
     public $bloque1_imagen1;
     public $bloque1_imagen2;
     public $bloque1_fondo;
     public $bloque2_titulo;
     public $bloque2_texto;
     public $bloque2_fondo;
     public $bloque3_titulo;
     public $bloque3_texto1;
     public $bloque3_icono1;
     public $bloque3_icono2;
     public $bloque3_icono3;
     public $bloque3_icono4;
     public $bloque3_imagen1;
     public $bloque3_texto2;
     public $bloque3_fondo;
     public $bloque4_imagen1;
     public $bloque5_titulo;
     public $bloque5_imagen1;
     public $bloque5_texto1;
     public $bloque5_texto2;
     public $bloque5_texto3;
     public $bloque6_titulo;
     public $bloque6_imagen;
     public $bloque6_texto1;
     public $bloque6_texto2;
     public $bloque6_texto3;
     public $bloque7_titulo;
     public $bloque7_imagen;
     public $bloque7_texto1;
     public $bloque7_texto2;
     public $bloque7_texto3;
     public $bloque8_titulo;
     public $bloque8_imagen;
     public $bloque8_texto1;
     public $bloque8_texto2;
     public $bloque8_texto3;
     public $bloque9_titulo;
     public $bloque9_imagen;
     public $bloque9_texto1;
     public $bloque9_texto2;
     public $bloque9_texto3;
     public $bloque10_fondo;
     public $bloque10_texto;
     public $enlace1;
     public $enlace2;
     public $enlace3;
     public $enlace4;
     public $enlace5;
     public $enlace6;
     public $enlace7;
     public $boton1_texto;
     public $boton2_texto;
     public $etiqueta1_texto;
     public $etiqueta2_texto;
     public $etiqueta3_texto;
     public $etiqueta4_texto;
     public $etiqueta5_texto;
     public $banner_movil;
     public $bloque1_fondo_movil;
     public $bloque5_etiqueta_usd;
     public $bloque6_etiqueta_usd;
     public $bloque7_etiqueta_usd;
     public $bloque8_etiqueta_usd;
     public $bloque9_etiqueta_usd;
     public $bloque5_txt_usd;
     public $bloque6_txt_usd;
     public $bloque7_txt_usd;
     public $bloque8_txt_usd;
     public $bloque9_txt_usd;

     private $transaction;

    /*
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['bloque1_texto1', 'bloque1_texto2', 'bloque2_titulo', 'bloque2_texto', 'bloque3_titulo', 'bloque3_texto1', 'bloque3_texto2', 'bloque3_icono1', 'bloque3_icono2', 'bloque3_icono3', 'bloque3_icono4', 'bloque5_titulo', 'bloque5_texto1', 'bloque5_texto2', 'bloque5_texto3', 'bloque6_titulo', 'bloque6_texto1', 'bloque6_texto2', 'bloque6_texto3', 'bloque7_titulo', 'bloque7_texto1', 'bloque7_texto2', 'bloque7_texto3', 'bloque8_titulo', 'bloque8_texto1', 'bloque8_texto2', 'bloque8_texto3', 'bloque9_titulo', 'bloque9_texto1', 'bloque9_texto2', 'bloque9_texto3', 'bloque10_texto', 'enlace1', 'enlace2', 'enlace3', 'enlace4', 'enlace5', 'enlace6', 'enlace7', 'boton1_texto', 'boton2_texto', 'etiqueta1_texto', 'etiqueta2_texto', 'etiqueta3_texto', 'etiqueta4_texto', 'etiqueta5_texto', 'bloque5_etiqueta_usd', 'bloque5_txt_usd', 'bloque6_etiqueta_usd', 'bloque6_txt_usd', 'bloque7_etiqueta_usd', 'bloque7_txt_usd', 'bloque8_etiqueta_usd', 'bloque8_txt_usd', 'bloque9_etiqueta_usd', 'bloque9_txt_usd'], 'string'],
            [['id'], 'integer'],
            [['bloque1_imagen1', 'bloque1_imagen2', 'bloque1_fondo', 'bloque2_fondo', 'bloque3_imagen1', 'bloque3_fondo', 'bloque4_imagen1', 'bloque5_imagen1', 'bloque6_imagen', 'bloque7_imagen', 'bloque8_imagen', 'bloque9_imagen', 'bloque10_fondo', 'banner_movil', 'bloque1_fondo_movil'],'file', 'extensions' => 'png, jpg'],
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
        $contenido = ContenidoHome::find()->one();
        $contenido->bloque1_texto1 = $this->bloque1_texto1;
        $contenido->bloque1_texto2 = $this->bloque1_texto2;
        $contenido->bloque2_titulo = $this->bloque2_titulo;
        $contenido->bloque2_texto = $this->bloque2_texto;
        $contenido->bloque3_titulo = $this->bloque3_titulo;
        $contenido->bloque3_texto1 = $this->bloque3_texto1;
        $contenido->bloque3_texto2 = $this->bloque3_texto2;
        $contenido->bloque5_titulo = $this->bloque5_titulo;
        $contenido->bloque5_texto1 = $this->bloque5_texto1;
        $contenido->bloque5_texto2 = $this->bloque5_texto2;
        $contenido->bloque5_texto3 = $this->bloque5_texto3;
        $contenido->bloque6_titulo = $this->bloque6_titulo;
        $contenido->bloque6_texto1 = $this->bloque6_texto1;
        $contenido->bloque6_texto2 = $this->bloque6_texto2;
        $contenido->bloque6_texto3 = $this->bloque6_texto3;
        $contenido->bloque7_titulo = $this->bloque7_titulo;
        $contenido->bloque7_texto1 = $this->bloque7_texto1;
        $contenido->bloque7_texto2 = $this->bloque7_texto2;
        $contenido->bloque7_texto3 = $this->bloque7_texto3;
        $contenido->bloque8_titulo = $this->bloque8_titulo;
        $contenido->bloque8_texto1 = $this->bloque8_texto1;
        $contenido->bloque8_texto2 = $this->bloque8_texto2;
        $contenido->bloque8_texto3 = $this->bloque8_texto3;
        $contenido->bloque9_titulo = $this->bloque9_titulo;
        $contenido->bloque9_texto1 = $this->bloque9_texto1;
        $contenido->bloque9_texto2 = $this->bloque9_texto2;
        $contenido->bloque9_texto3 = $this->bloque9_texto3;
        $contenido->bloque10_texto = $this->bloque10_texto;
        $contenido->boton1_texto = $this->boton1_texto;
        $contenido->boton2_texto = $this->boton2_texto;
        $contenido->enlace1 = $this->enlace1;
        $contenido->enlace2 = $this->enlace2;
        $contenido->enlace3 = $this->enlace3;
        $contenido->enlace4 = $this->enlace4;
        $contenido->enlace5 = $this->enlace5;
        $contenido->enlace6 = $this->enlace6;
        $contenido->enlace7 = $this->enlace7;
        $contenido->etiqueta1_texto = $this->etiqueta1_texto;
        $contenido->etiqueta2_texto = $this->etiqueta2_texto;
        $contenido->etiqueta3_texto = $this->etiqueta3_texto;
        $contenido->etiqueta4_texto = $this->etiqueta4_texto;
        $contenido->etiqueta5_texto = $this->etiqueta5_texto;
        $contenido->bloque5_etiqueta_usd = $this->bloque5_etiqueta_usd;
        $contenido->bloque6_etiqueta_usd = $this->bloque6_etiqueta_usd;
        $contenido->bloque7_etiqueta_usd = $this->bloque7_etiqueta_usd;
        $contenido->bloque8_etiqueta_usd = $this->bloque8_etiqueta_usd;
        $contenido->bloque9_etiqueta_usd = $this->bloque9_etiqueta_usd;
        $contenido->bloque5_txt_usd = $this->bloque5_txt_usd;
        $contenido->bloque6_txt_usd = $this->bloque6_txt_usd;
        $contenido->bloque7_txt_usd = $this->bloque7_txt_usd;
        $contenido->bloque8_txt_usd = $this->bloque8_txt_usd;
        $contenido->bloque9_txt_usd = $this->bloque9_txt_usd;

        $ruta1 = $this->guardaImagenes('bloque1_imagen1');
        if($ruta1){
            $contenido->bloque1_imagen1 = $ruta1;
        }
        $ruta2 = $this->guardaImagenes('bloque1_imagen2');
        if($ruta2){
            $contenido->bloque1_imagen2 = $ruta2;
        }
        $ruta3 = $this->guardaImagenes('bloque1_fondo');
        if($ruta3){
            $contenido->bloque1_fondo = $ruta3;
        }
        $ruta4 = $this->guardaImagenes('bloque2_fondo');
        if($ruta4){
            $contenido->bloque2_fondo = $ruta4;
        }
        $ruta5 = $this->guardaImagenes('bloque3_imagen1');
        if($ruta5){
            $contenido->bloque3_imagen1 = $ruta5;
        }
        $ruta6 = $this->guardaImagenes('bloque4_imagen1');
        if($ruta6){
            $contenido->bloque4_imagen1 = $ruta6;
        }
        $ruta7 = $this->guardaImagenes('bloque5_imagen1');
        if($ruta7){
            $contenido->bloque5_imagen1 = $ruta7;
        }
        $ruta8 = $this->guardaImagenes('bloque6_imagen');
        if($ruta8){
            $contenido->bloque6_imagen = $ruta8;
        }
        $ruta9 = $this->guardaImagenes('bloque7_imagen');
        if($ruta9){
            $contenido->bloque7_imagen = $ruta9;
        }
        $ruta10 = $this->guardaImagenes('bloque8_imagen');
        if($ruta10){
            $contenido->bloque8_imagen = $ruta10;
        }
        $ruta11 = $this->guardaImagenes('bloque9_imagen');
        if($ruta11){
            $contenido->bloque9_imagen = $ruta11;
        }
        $ruta12 = $this->guardaImagenes('bloque10_fondo');
        if($ruta12){
            $contenido->bloque10_fondo = $ruta12;
        }
        $ruta13 = $this->guardaImagenes('bloque3_fondo');
        if($ruta13){
            $contenido->bloque3_fondo = $ruta13;
        }
        $ruta14 = $this->guardaImagenes('banner_movil');
        if($ruta14){
            $contenido->banner_movil = $ruta14;
        }
        $ruta15 = $this->guardaImagenes('bloque1_fondo_movil');
        if($ruta15){
            $contenido->bloque1_fondo_movil = $ruta15;
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
        $this->bloque1_imagen1 = UploadedFile::getInstance($this, $imagen);
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
            $nombre_archivo = $timestamp.preg_replace("/[^a-z0-9\.]/", "", strtolower($this->bloque1_imagen1));
            if(!file_exists($ruta.'/'.$nombre_archivo)){
                if(!$this->bloque1_imagen1->saveAs($ruta.'/'.$nombre_archivo, false )){
                    return false;
                }
                if(!$this->bloque1_imagen1->saveAs($ruta_frontend.'/'.$nombre_archivo, false )){
                    return false;
                }
             $guardado = true;
             }
        }
        $ruta_bd = Url::base(true).'/images/'.preg_replace("/[^a-z0-9\.]/", "", strtolower($nombre_archivo));
        return $ruta_bd;
    }
}
