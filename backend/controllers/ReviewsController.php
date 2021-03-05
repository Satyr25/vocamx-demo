<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\search\ReviewSearch;
use app\models\Review;
use backend\models\forms\ReviewForm;

/**
 * Reviews controller
 */
class ReviewsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id){
        $review = Review::findOne($id);
        return $this->render('view',[
            'review' => $review
        ]);
    }

    public function actionDelete($id){
        $review = Review::findOne($id);
        $review->status = '0';
        if(!$review->save()){
            Yii::$app->session->setFlash('error', "Ocurrió un error al eliminar la reseña.");
        }else{
            Yii::$app->session->setFlash('success', "La reseña se eliminó correctamente.");
        }
        return $this->redirect(['reviews/']);
    }

    public function actionUpdate($id){
        $review = new ReviewForm();
        if ($review->load(Yii::$app->request->post())) {
            if ($review->actualizar($id)) {
                Yii::$app->session->setFlash('success', "La reseña se actualizó correctamente");
                return $this->redirect(['reviews/']);
            }else{
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar la reseña.");
                return $this->refresh();
            }
        }

       $review->cargarDatos($id);

       return $this->render('update', [
           'review' => $review,
       ]);
    }

}
