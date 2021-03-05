<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Producto;
use frontend\models\PersonalizadaForm;
use app\models\PlantillaFiltro;

class PersonalizacionController extends Controller
{
    public function actionIndex(){
    	$filtros = PlantillaFiltro::find()->all();
        $formulario = new PersonalizadaForm();
        return $this->render('index',[
            'formulario' => $formulario,
            'filtros' => $filtros
        ]);


    }
}
