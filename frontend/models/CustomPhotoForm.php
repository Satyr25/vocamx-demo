<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\PersonalizaFoto;
use app\models\Menu;

/**
 * ContactForm is the model behind the contact form.
 */
class CustomPhotoForm extends Model
{
    public $elementos;
    public $fotoCustom;
    public $comentarios;
    public $precio;
    public $modelId;    
    public $fotoRoute;
    public $mensaje;
    public $menu;
    public $color;
    private $transaction;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['elementos', 'fotoCustom'],
                'required',
                'message' => '{attribute} es requerido'
            ],
            [['elementos'], 'integer', 'min' => 0],
            [['comentarios','mensaje','color','menu'], 'string'],
            [['fotoCustom'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg,svg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'elementos' => 'Cantidad',
            'fotoCustom' => 'Subir tu foto',
            'comentarios' => 'Comentarios adicionales',
            'precio' => 'Precio Introducción',
            'mensaje' => 'mensaje',
            'color' => 'color',
        ];
    }

    public function guardar()
    {
        $connection = \Yii::$app->db;
        $this->transaction = $connection->beginTransaction();

        $model = new PersonalizaFoto();
        $model->elementos = $this->elementos;
        $model->comentarios = $this->comentarios;
        $model->mensaje = $this->mensaje;
        $model->color = $this->color;

        if(!$this->guardaFotos()){
            $this->transaction->rollback();
            return false;
        }
        $model->custom_photo = $this->fotoRoute;
        if(!$model->save()){
            $this->transaction->rollback();
            return false;
        }

        if(is_array($this->menu)){
            foreach ($this->menu as $menu) {
                $menuModel = new Menu();
                $menuModel->posicion = $menu;
                $menuModel->personaliza_foto_id = $model->id;
            if(!$menuModel->save()){
                $this->transaction->rollback();
                return false;
                }
            }
        } else{
                $menuModel = new Menu();
                $menuModel->posicion = $this->menu;
                $menuModel->personaliza_foto_id = $model->id;
            if(!$menuModel->save()){
                $this->transaction->rollback();
                return false;
            }
        }

        $this->modelId = $model->id;

        $this->transaction->commit();
        return true;
    }

    public function guardaFotos()
    {
        $this->fotoCustom = UploadedFile::getInstance($this, 'fotoCustom');
        if ($this->fotoCustom) {
            $ruta = Yii::getAlias('@backend/web/images/') . 'userPhotos';
            $ruta_frontend = Yii::getAlias('@frontend/web/images/') . 'userPhotos';
            $guardado = false;
            while (!$guardado) {
                $timestamp = time();
                $nombre_archivo = $timestamp . preg_replace("/[^a-z0-9\.]/", "", strtolower($this->fotoCustom->name));
                if (!file_exists($ruta . '/' . $nombre_archivo)) {
                    if (!$this->fotoCustom->saveAs($ruta . '/' . $nombre_archivo, false)) {
                        return false;
                    }
                    if (!$this->fotoCustom->saveAs($ruta_frontend . '/' . $nombre_archivo, false)) {
                        return false;
                    }
                    $guardado = true;
                }
            }
            $this->fotoRoute = 'userPhotos/' . $nombre_archivo;
        }
        return true;
    }

}
