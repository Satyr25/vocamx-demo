<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\ContenidoGarantias;

class GarantiasController extends Controller
{
    public function actionIndex(){
        $searchModel = new ContenidoGarantias();
        $contenido = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'contenido' => $contenido,
        ]);
    }
}
