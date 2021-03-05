<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use app\models\Medidas;
use yii\helpers\Url;

/**
 * ContactForm is the model behind the contact form.
 */
class MedidaForm extends Model
{
     public $medida;
     public $precio;
     public $precio_usd;
     public $id;

    /*
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['medida'], 'required'],
            [['id'], 'integer'],
            [['medida'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    public function guardar(){
        $nueva_medida = new Medidas();
        $nueva_medida->medidas = $this->medida;
        if(!$nueva_medida->save()){
            return false;
        }
        return true;
    }

    public function actualizar(){
        $medida = Medidas::findOne($this->id);
        $medida->medidas = $this->medida;
        if(!$medida->save()){
            return false;
        }
        return true;
    }
}
