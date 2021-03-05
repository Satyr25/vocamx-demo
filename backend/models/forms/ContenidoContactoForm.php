<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\ContenidoContacto;
use yii\helpers\Url;

/**
 * ContactForm is the model behind the contact form.
 */
class ContenidoContactoForm extends Model
{
     public $id;
     public $bloque1_titulo;
     public $bloque2_titulo;
     public $bloque1_texto;
     public $bloque2_texto;
     public $correo;
     public $imagen1;
    public $telefono;

     private $imagen;
     private $transaction;

    /*
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['bloque1_titulo', 'bloque2_titulo', 'bloque1_texto', 'bloque2_texto', 'correo', 'telefono' ], 'string'],
            [['id'], 'integer'],
            [['imagen1'],'file', 'extensions' => 'png, jpg'],
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
        $contenido = ContenidoContacto::find()->one();
        if(!$contenido){
            $contenido = new ContenidoContacto();
        }
        $contenido->bloque1_titulo = $this->bloque1_titulo;
        $contenido->bloque2_titulo = $this->bloque2_titulo;
        $contenido->bloque1_texto = $this->bloque1_texto;
        $contenido->bloque2_texto = $this->bloque2_texto;
        $contenido->correo = $this->correo;
        $contenido->telefono = $this->telefono;

        $ruta1 = $this->guardaImagenes('imagen1');
        if($ruta1){
            $contenido->imagen1 = $ruta1;
        }

        if (!$contenido->save()) {
            var_dump($contenido->getErrors());exit;
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
