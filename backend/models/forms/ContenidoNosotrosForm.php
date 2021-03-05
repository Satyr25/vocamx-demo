<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\ContenidoNosotros;
use yii\helpers\Url;

/**
 * ContactForm is the model behind the contact form.
 */
class ContenidoNosotrosForm extends Model
{
     public $id;
     public $bloque1_titulo;
     public $bloque2_titulo;
     public $bloque3_titulo;
     public $bloque4_titulo;
     public $bloque5_titulo;
     public $bloque1_texto;
     public $bloque2_texto;
     public $bloque3_texto;
     public $bloque4_texto;
     public $bloque5_texto;
     public $bloque5_texto2;
     public $correo1;
     public $imagen1;
     public $logo1;

     private $imagen;
     private $transaction;

    /*
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['bloque1_titulo', 'bloque2_titulo', 'bloque3_titulo', 'bloque4_titulo', 'bloque5_titulo', 'bloque1_texto', 'bloque2_texto', 'bloque3_texto', 'bloque4_texto', 'bloque5_texto', 'correo1' ], 'string'],
            [['id'], 'integer'],
            [['imagen1', 'imagen2'],'file', 'extensions' => 'png, jpg'],
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
        $contenido = ContenidoNosotros::find()->one();
        if(!$contenido){
            $contenido = new ContenidoNosotros();
        }
        $contenido->bloque1_titulo = $this->bloque1_titulo;
        $contenido->bloque2_titulo = $this->bloque2_titulo;
        $contenido->bloque3_titulo = $this->bloque3_titulo;
        $contenido->bloque4_titulo = $this->bloque4_titulo;
        $contenido->bloque5_titulo = $this->bloque5_titulo;
        $contenido->bloque1_texto = $this->bloque1_texto;
        $contenido->bloque2_texto = $this->bloque2_texto;
        $contenido->bloque3_texto = $this->bloque3_texto;
        $contenido->bloque4_texto = $this->bloque4_texto;
        $contenido->bloque5_texto = $this->bloque5_texto;
        $contenido->correo1 = $this->correo1;

        $ruta1 = $this->guardaImagenes('imagen1');
        if($ruta1){
            $contenido->imagen1 = $ruta1;
        }
        $ruta2 = $this->guardaImagenes('logo1');
        if($ruta2){
            $contenido->logo1 = $ruta2;
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
