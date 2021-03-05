<?php
namespace frontend\models;

use yii\base\Model;

class PersonalizadaForm extends Model
{
    public $diseno;
    public $linea1;
    public $linea2;
    public $linea3;
    public $imagen;

    private $transaction;

    public function rules()
    {
        return [
            [['diseno'],'required'],
            [['diseno','linea1','linea2','linea3', 'imagen'], 'string']
        ];
    }

    public function crear(){
    }

}
