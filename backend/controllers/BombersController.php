<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\models\forms\ProductoForm;
use app\models\search\ProductoSearch;
use app\models\Producto;
use app\models\Categoria;
use app\models\Talla;
use app\models\Sexo;
use app\models\Tipo;
use backend\models\forms\MensualidadesForm;
use app\models\Mensualidades;
use richardfan\sortable\SortableAction;
use backend\models\forms\FiltrosPlantillasForm;
use app\models\Plantilla;
use app\models\Filtro;

/**
 * Site controller
 */
class BombersController extends Controller
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
                        'actions' => ['index', 'agregar', 'view', 'agregar-coleccion', 'update', 'delete', 'ordenar', 'sortItem', 'filtrar-plantillas', 'mensualidades'],
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
                'class' => SortableAction::className(),
                'activeRecordClassName' => Producto::className(),
                'orderColumn' => 'orden',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $mensualidades = new MensualidadesForm();
        $mensualidades->mensualidades = ArrayHelper::map(Mensualidades::find()->where(['activo' => 1])->all(),'id','id');
        return $this->render('index', [
            'mensualidades' => $mensualidades,
            'numero_mensualidades' => ArrayHelper::map(Mensualidades::find()->all(), 'id', 'descripcion'),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOrdenar() {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->searchOrder(Yii::$app->request->queryParams);
        return $this->render('ordenar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAgregar(){
        $producto = new ProductoForm();
        if ($producto->load(Yii::$app->request->post())) {
            if ($producto->guardar()) {
                Yii::$app->session->setFlash('success', "Producto creado correctamente");
                return $this->redirect(['bombers/']);

            }else{
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el producto.");
                return $this->refresh();
            }
        }
        return $this->render('agregar',[
            'producto' => $producto,
            'categorias' => ArrayHelper::map(Categoria::find()->all(), 'id', 'nombre'),
            'tallas' => ArrayHelper::map(Talla::find()->orderBy(['orden'=>SORT_ASC])->all(), 'id', 'talla'),
            'sexos' => ArrayHelper::map(Sexo::find()->all(), 'id', 'sexo'),
            'tipos' => ArrayHelper::map(Tipo::find()->all(), 'id', 'nombre'),
        ]);
    }

    public function actionView($id){
        $producto = new Producto();
        return $this->render('view',[
            'producto' => $producto->datos($id),
            'tallas' => $producto->tallas($id),
            'fotos' => $producto->fotos($id)
        ]);
    }

    public function actionDelete($id){
        $bomber = Producto::findOne($id);
        $bomber->status = '0';
        if(!$bomber->save()){
            Yii::$app->session->setFlash('error', "Ocurrió un error al eliminar el producto.");
        }else{
            Yii::$app->session->setFlash('success', "El producto se eliminó correctamente.");
        }
        return $this->redirect(['bombers/']);
    }

    public function actionUpdate($id){
        $producto = new ProductoForm();
        if ($producto->load(Yii::$app->request->post())) {
            if(isset(Yii::$app->request->post()['ProductoForm']['fotos_elim']))
            {
                $producto->fotos_elim = Yii::$app->request->post()['ProductoForm']['fotos_elim'];
            }

            if ($producto->actualizar($id)) {
                Yii::$app->session->setFlash('success', "El producto se actualizó correctamente");
                return $this->redirect(['bombers/']);

            }else{
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el producto.");
                return $this->refresh();
            }
        }

       $producto->cargarDatos($id);

       return $this->render('update', [
           'producto' => $producto,
           'categorias' => ArrayHelper::map(Categoria::find()->all(), 'id', 'nombre'),
           'sexos' => ArrayHelper::map(Sexo::find()->all(), 'id', 'sexo'),
           'tallas' => ArrayHelper::map(Talla::find()->orderBy(['orden'=>SORT_ASC])->all(), 'id', 'talla'),
            'tipos' => ArrayHelper::map(Tipo::find()->all(), 'id', 'nombre'),
       ]);
    }

    public function actionFiltrarPlantillas(){
        $filtroForm = new FiltrosPlantillasForm();
        if ($filtroForm->load(Yii::$app->request->post())) {
            if ($filtroForm->guardar()) {
                Yii::$app->session->setFlash('success', "Producto creado correctamente");
                return $this->redirect(['bombers/']);
            }else{
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el producto.");
                return $this->refresh();
            }
        }
        $filtroForm->loadData();
        $plantillas = Plantilla::find()->all();
        $filtros = ArrayHelper::map(Filtro::find()->all(), 'id', 'filtro');
        return $this->render('filtrar_plantillas',[
            'filtroForm' => $filtroForm,
            'plantillas' => $plantillas,
            'filtros' => $filtros
        ]);
    }
        public function actionMensualidades(){
        $mensualidades = new MensualidadesForm();
        if ($mensualidades->load(Yii::$app->request->post())) {
//             var_dump(Yii::$app->request->post());exit;
            if ($mensualidades->actualizar()) {
                Yii::$app->session->setFlash('success', "El contenido se actualizó correctamente");
                return $this->redirect(['bombers/index']);
            }else{
                var_dump($contacto->getErrors());exit;
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el contenido.");
                return $this->refresh();
            }
        }
    }
}
