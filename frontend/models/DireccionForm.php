<?php
namespace frontend\models;

use yii\base\Model;
use app\models\Cliente;
use app\models\Estado;

/**
 * Signup form
 */
class DireccionForm extends Model
{
    public $pais;
    public $estado;
    public $estado_seleccionado;
    public $ciudad;
    public $usuario;
    public $cp;
    public $calle;
    public $externo;
    public $interno;
    public $entre_calles;
    public $referencias;
    public $colonia;
    public $nombre;
    public $telefono;
    public $id_direccion;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cp','calle','externo','colonia','nombre','telefono', 'estado', 'pais', 'ciudad'], 'required'],
            [['cp', 'id_direccion', 'estado', 'pais'],'integer'],
            [['calle','externo', 'interno','entre_calles','referencias','colonia', 'nombre','telefono', 'ciudad'], 'string']
        ];
    }

    public function crear()
    {
        if (!$this->validate()) {
            return null;
        }

        $cliente = new Cliente();
        $cliente->user_id = \Yii::$app->user->identity->id;
        $cliente->pais_id = $this->pais;
        $cliente->estado_id = $this->estado;
        $cliente->ciudad = $this->ciudad;
        $cliente->nombre = $this->nombre;
        $cliente->telefono = $this->telefono;
        $cliente->calle = $this->calle;
        $cliente->num_ext = $this->externo;
        $cliente->colonia = $this->colonia;
        $cliente->cp = $this->cp;
        $cliente->entre_calles = $this->entre_calles;
        $cliente->referencias = $this->referencias;
        if(!$cliente->save()){
            return false;
        }
        return true;
    }

    public function cargar($id){
        $cliente = Cliente::findOne($id);
        if(!$cliente || $cliente->user_id != \Yii::$app->user->identity->id){
            return false;
        }
        if($cliente->estado_id){
            $estado = Estado::findOne($cliente->estado_id);
            $this->estado_seleccionado = $estado->estadonombre;
        }
        $this->id_direccion = $cliente->id;
        $this->pais = $cliente->pais_id;
        $this->estado = $cliente->estado_id;
        $this->ciudad = $cliente->ciudad;
        $this->nombre = $cliente->nombre;
        $this->telefono = $cliente->telefono;
        $this->calle = $cliente->calle;
        $this->externo = $cliente->num_ext;
        $this->colonia = $cliente->colonia;
        $this->cp = $cliente->cp;
        $this->entre_calles = $cliente->entre_calles;
        $this->referencias = $cliente->referencias;
        return true;
    }

    public function actualizar(){
        if(!$this->id_direccion){
            return false;
        }
        $cliente = Cliente::findOne($this->id_direccion);
        if(!$cliente){
            return false;
        }
        $cliente->pais_id = $this->pais;
        $cliente->estado_id = $this->estado;
        $cliente->ciudad = $this->ciudad;
        $cliente->nombre = $this->nombre;
        $cliente->telefono = $this->telefono;
        $cliente->calle = $this->calle;
        $cliente->num_ext = $this->externo;
        $cliente->colonia = $this->colonia;
        $cliente->cp = $this->cp;
        $cliente->entre_calles = $this->entre_calles;
        $cliente->referencias = $this->referencias;
        if(!$cliente->save()){
            return false;
        }
        return true;
    }
}
