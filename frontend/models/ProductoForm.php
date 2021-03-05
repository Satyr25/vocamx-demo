<?php
namespace frontend\models;

use yii\base\Model;
use app\models\Cliente;
use app\models\PersonalizaFoto;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class ProductoForm extends Model
{
    public $producto;
    public $diseno;
    public $linea1;
    public $linea2;
    public $linea3;
    public $imagen_personalizada;
    public $talla;
    public $cantidad;
    public $comentarios;
    public $foto_id;
    public $fotoCustom;

    private $fotoRoute;

    public $color_decoracion;
    public $medida_decoracion;
    public $costo_variante;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['producto', 'talla', 'cantidad'], 'required'],
            [['producto', 'talla', 'cantidad', 'foto_id', 'color_decoracion', 'medida_decoracion'],'integer'],
            [['costo_variante'],'double'],
            [['diseno', 'linea1', 'linea2', 'linea3','imagen_personalizada', 'comentarios'], 'string'],
            [['fotoCustom'], 'file', 'extensions' => 'png, jpg, jpeg, svg'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function agregar()
    {
        if (!$this->validate()) {
            return null;
        }

        $custom = false;
        if($this->guardaFotos()){
            $custom = [
                'diseno' => '',
                'linea1' => '',
                'linea2' => '',
                'linea3' => '',
                'imagen' => $this->fotoRoute,
                'coleccion' => true
            ];
        }else if ($this->diseno != '') {
            $custom = [
                'diseno' => $this->diseno,
                'linea1' => $this->linea1,
                'linea2' => $this->linea2,
                'linea3' => $this->linea3,
                'imagen' => $this->imagen_personalizada,];
        }
        if($this->costo_variante){
            $decoracion = [
                'color' => $this->color_decoracion,
                'medidas' => $this->medida_decoracion,
                'costo' => $this->costo_variante
            ];

            $agregar = \Yii::$app->Carrito->agregar(
                $this->producto,
                $this->talla,
                $this->cantidad,
                $this->comentarios,
                null,
                $this->foto_id,
                $decoracion
            );
        }else{
            $agregar = \Yii::$app->Carrito->agregar(
                $this->producto,
                $this->talla,
                $this->cantidad,
                $this->comentarios,
                $custom,
                $this->foto_id
            );
        }

        if(!$agregar['exito']){
            return false;
        }
        return true;
    }

    public function guardaFotos()
    {
        $this->fotoCustom = UploadedFile::getInstance($this, 'fotoCustom');
        if ($this->fotoCustom) {
            $ruta = \Yii::getAlias('@backend/web/images/') . 'userPhotos';
            $ruta_frontend = \Yii::getAlias('@frontend/web/images/') . 'userPhotos';
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
            return true;
        }
        return false;
    }
}
