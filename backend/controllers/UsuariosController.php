<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use app\models\search\UserSearch;
use backend\models\forms\UsuarioForm;

/**
 * Site controller
 */
class UsuariosController extends Controller
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
                        'actions' => ['index', 'update', 'agregar', 'eliminar'],
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
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAgregar(){
        $usuario = new UsuarioForm();
        if ($usuario->load(Yii::$app->request->post())) {
            if ($usuario->guardar()) {
                Yii::$app->session->setFlash('success', "Usuario creado correctamente");
                return $this->redirect(['usuarios/']);

            }else{
                Yii::$app->session->setFlash('error', "Ocurrió un error al crear el usuario.");
                return $this->refresh();
            }
        }
        return $this->render('agregar',[
            'usuario' => $usuario
        ]);
    }

    public function actionEliminar($id){
        $usuario = User::findOne($id);
        if(!$usuario->delete()){
            Yii::$app->session->setFlash('error', "Ocurrió un error al eliminar el usuario.");
        }else{
            Yii::$app->session->setFlash('success', "El usuario se eliminó correctamente.");
        }
        return $this->redirect(['usuarios/']);
    }

    public function actionUpdate($id){
        $usuario = new UsuarioForm();
        if ($usuario->load(Yii::$app->request->post())) {
            if ($usuario->actualizar($id)) {
                Yii::$app->session->setFlash('success', "El usuario se actualizó correctamente");
                return $this->redirect(['usuarios/']);

            }else{
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el usuario.");
                return $this->refresh();
            }
        }

       $usuario->cargarDatos($id);

       return $this->render('update', [
           'usuario' => $usuario
       ]);
    }

}
