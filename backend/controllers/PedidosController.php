<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\Pedido;
use app\models\Cliente;
use app\models\EstadoPedido;
use app\models\search\PedidoSearch;
use app\models\Cupon;

/**
 * Site controller
 */
class PedidosController extends Controller
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
                        'actions' => ['index', 'view','enviado'],
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
        $searchModel = new PedidoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'estados' => ArrayHelper::map(EstadoPedido::find()->all(), 'id', 'nombre')
        ]);
    }

    public function actionView($id){
        $pedido = new Pedido();
        $pedido = $pedido->datosPedido($id);
        $productos = $pedido->productos($id);
        $cliente = Cliente::findOne($pedido->cliente);
        return $this->render('view',[
            'pedido' => $pedido,
            'cliente' => $cliente,
            'productos' => $productos,
            'cupon' => Cupon::findOne($pedido->cupon)
        ]);
    }

    public function actionEnviado($id){
        $pedido = Pedido::findOne($id);
        $enviado = EstadoPedido::find()->where('clave="ENV"')->one();
        $pedido->estado_pedido_id = $enviado->id;
        if($pedido->update()){
            \Yii::$app->session->setFlash('success', 'El pedido cambio de estado correctamente.');
            return $this->redirect(['pedidos/']);
        }else{
            \Yii::$app->session->setFlash('error', 'Ocurrió un error al cambiar el pedido.');
            return $this->refresh();
        }
    }

}
