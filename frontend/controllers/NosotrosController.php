<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\ContenidoNosotros;

class NosotrosController extends Controller
{
    public function actionIndex(){
        $searchModel = new ContenidoNosotros();
        $contenido = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'contenido' => $contenido,
        ]);
    }
}
