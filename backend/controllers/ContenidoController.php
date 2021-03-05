<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\ContenidoHome;
use backend\models\forms\ContenidoForm;
use app\models\search\ContenidoSearch;
use app\models\ContenidoGarantias;
use backend\models\forms\ContenidoGarantiasForm;
use app\models\search\ContenidoGarantiasSearch;
use app\models\ContenidoContacto;
use backend\models\forms\ContenidoContactoForm;
use app\models\ContenidoNosotros;
use backend\models\forms\ContenidoNosotrosForm;
use app\models\ContenidoHeader;
use backend\models\forms\ContenidoHeaderForm;
use app\models\ContenidoBombers;
use backend\models\forms\ContenidoBombersForm;
/**
 * Site controller
 */
class ContenidoController extends Controller
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
                        'actions' => ['index','home', 'update', 'garantias', 'update2', 'contacto', 'update3', 'nosotros', 'updatenosotros', 'header', 'updateheader', 'bombers', 'updatebombers'],
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
            'sortItem' => [
                //'class' => SortableAction::className(),
                //'activeRecordClassName' => Producto::className(),
                //'orderColumn' => 'orden',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionHome(){
        $contenidoForm = new ContenidoForm();
        $searchModel = new ContenidoSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('home', [
            'contenidoForm' => $contenidoForm,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionUpdate(){
        $contenido = new ContenidoForm();
        if ($contenido->load(Yii::$app->request->post())) {
            if ($contenido->actualizar()) {
                Yii::$app->session->setFlash('success', "El contenido se actualizó correctamente");
                return $this->redirect(['contenido/home']);
            }else{
                var_dump($contenido->getErrors());exit;
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el contenido.");
                return $this->refresh();
            }
        }
    }

    public function actionGarantias(){
        $contenidoForm = new ContenidoGarantiasForm();
        $searchModel = new ContenidoGarantiasSearch();

        $contenido = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('garantias', [
            'contenidoForm' => $contenidoForm,
            'contenido' => $contenido,
        ]);
    }
    public function actionUpdate2(){
        $garantias = new ContenidoGarantiasForm();
        if ($garantias->load(Yii::$app->request->post())) {
            if ($garantias->actualizar()) {
                Yii::$app->session->setFlash('success', "El contenido se actualizó correctamente");
                return $this->redirect(['contenido/garantias']);
            }else{
                var_dump($garantias->getErrors());exit;
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el contenido.");
                return $this->refresh();
            }
        }
    }

    public function actionContacto(){
        $contenidoForm = new ContenidoContactoForm();
        $searchModel = new ContenidoContacto();

        $contenido = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('contacto', [
            'contenidoForm' => $contenidoForm,
            'contenido' => $contenido,
        ]);
    }
    public function actionUpdate3(){
        $contacto = new ContenidoContactoForm();
        if ($contacto->load(Yii::$app->request->post())) {
            if ($contacto->actualizar()) {
                Yii::$app->session->setFlash('success', "El contenido se actualizó correctamente");
                return $this->redirect(['contenido/contacto']);
            }else{
                var_dump($contacto->getErrors());exit;
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el contenido.");
                return $this->refresh();
            }
        }
    }
    
    public function actionNosotros(){
        $contenidoForm = new ContenidoNosotrosForm();
        $searchModel = new ContenidoNosotros();

        $contenido = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('nosotros', [
            'contenidoForm' => $contenidoForm,
            'contenido' => $contenido,
        ]);
    }
    public function actionUpdatenosotros(){
        $contacto = new ContenidoNosotrosForm();
        if ($contacto->load(Yii::$app->request->post())) {
            if ($contacto->actualizar()) {
                Yii::$app->session->setFlash('success', "El contenido se actualizó correctamente");
                return $this->redirect(['contenido/nosotros']);
            }else{
                var_dump($contacto->getErrors());exit;
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el contenido.");
                return $this->refresh();
            }
        }
    }
    public function actionHeader(){
        $contenidoForm = new ContenidoHeaderForm();
        $searchModel = new ContenidoHeader();

        $contenido = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('header', [
            'contenidoForm' => $contenidoForm,
            'contenido' => $contenido,
        ]);
    }
    public function actionUpdateheader(){
        $contacto = new ContenidoHeaderForm();
        if ($contacto->load(Yii::$app->request->post())) {
            if ($contacto->actualizar()) {
                Yii::$app->session->setFlash('success', "El contenido se actualizó correctamente");
                return $this->redirect(['contenido/header']);
            }else{
                var_dump($contacto->getErrors());exit;
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el contenido.");
                return $this->refresh();
            }
        }
    }
    
    public function actionBombers(){
        $contenidoForm = new ContenidoBombersForm();
        $searchModel = new ContenidoBombers();

        $contenido = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('bombers', [
            'contenidoForm' => $contenidoForm,
            'contenido' => $contenido,
        ]);
    }
    public function actionUpdatebombers(){
        $contacto = new ContenidoBombersForm();
        if ($contacto->load(Yii::$app->request->post())) {
            if ($contacto->actualizar()) {
                Yii::$app->session->setFlash('success', "El contenido se actualizó correctamente");
                return $this->redirect(['contenido/bombers']);
            }else{
                var_dump($contacto->getErrors());exit;
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el contenido.");
                return $this->refresh();
            }
        }
    }
}
