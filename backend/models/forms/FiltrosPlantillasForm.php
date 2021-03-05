<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use app\models\PlantillaFiltro;

/**
 * ContactForm is the model behind the contact form.
 */
class FiltrosPlantillasForm extends Model
{
    public $filtros;
    private $transaction;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['filtros', 'each', 'rule' => ['integer']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'filtros' => 'Filtros'
        ];
    }

    public function guardar(){
        $connection = \Yii::$app->db;
        $this->transaction = $connection->beginTransaction();

        $filtrosExistentes = PlantillaFiltro::find()->all();
        if(!empty($filtrosExistentes)){
            foreach($filtrosExistentes as $filtroExistente){
                $filtroExistente->delete();
            }
        }

        foreach($this->filtros as $id => $filtros){
            if(empty($filtros)){
                continue;
            }
            foreach($filtros as $filtro){
                $plantillaFiltro = new PlantillaFiltro();
                $plantillaFiltro->plantilla_id = $id;
                $plantillaFiltro->filtro_id = $filtro;
                if(!$plantillaFiltro->save()){
                    $this->transaction->rollback();
                    return false;
                }
            }
        }

        $this->transaction->commit();
        return true;
    }

    public function loadData(){
        $this->filtros = [];
        $filtrosExistentes = PlantillaFiltro::find()->all();
        foreach($filtrosExistentes as $filtroExistente){
            $this->filtros[$filtroExistente->plantilla_id][] = $filtroExistente->filtro_id;
        }
    }
}
