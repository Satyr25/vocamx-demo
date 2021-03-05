<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use app\models\Mensualidades;
use yii\helpers\Url;

/**
 * ContactForm is the model behind the contact form.
 */
class MensualidadesForm extends Model
{
     public $mensualidades;

    /*
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mensualidades'], 'each', 'rule' => 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    public function actualizar(){
        
        $meses = Mensualidades::find()->all();
        foreach($meses as $mes){
            $mes->activo = 0;
            if(!$mes->save()){
                return false;
            }
        }
        
        if ($this->mensualidades != ''){
            foreach($this->mensualidades as $meses){
                $mes = Mensualidades::find()->where('id = '.$meses)->one();
                $mes->activo = 1;
                if(!$mes->save()){
                    return false;
                }
            }
        }
        return true;
    }
}
