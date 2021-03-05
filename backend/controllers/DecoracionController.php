<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\models\forms\ProductoForm;
use app\models\search\ProductoSearch;
use backend\models\forms\ColorForm;
use app\models\search\ColorSearch;
use backend\models\forms\MedidaForm;
use app\models\search\MedidasSearch;
use app\models\Producto;
use app\models\Categoria;
use app\models\Talla;
use app\models\Sexo;
use app\models\Tipo;
use app\models\ColorDecoracion;
use app\models\Medidas;
use backend\models\forms\MensualidadesForm;
use app\models\Mensualidades;
use richardfan\sortable\SortableAction;
use backend\models\forms\FiltrosPlantillasForm;
use app\models\Plantilla;
use app\models\Filtro;
use app\models\VarianteDecoracion;
use app\models\FotoColor;

/**
 * Site controller
 */
class DecoracionController extends Controller
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
                        'actions' => [],
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
        $dataProvider = $searchModel->searchDeco(Yii::$app->request->queryParams);
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
        $dataProvider = $searchModel->searchOrderDeco(Yii::$app->request->queryParams);
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
                return $this->redirect(['decoracion/']);

            }else{
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el producto.");
                return $this->refresh();
            }
        }
        return $this->render('agregar',[
            'producto' => $producto,
            'categorias' => ArrayHelper::map(Categoria::find()->where(['clave' => 'DECO'])->all(), 'id', 'nombre'),
            'colores' => ArrayHelper::map(ColorDecoracion::find()->orderBy(['color'=>SORT_ASC])->all(), 'id', 'color'),
            'medidas' => ArrayHelper::map(Medidas::find()->all(), 'id', 'medidas'),
        ]);
    }

    public function actionView($id){
        $producto = new Producto();
        $variantes = new VarianteDecoracion();
        return $this->render('view',[
            'producto' => $producto->datos($id),
            'tallas' => $producto->tallas($id),
            'fotos' => $producto->fotos($id),
            'variantes' => $variantes->variantesProducto($id)
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
        return $this->redirect(['decoracion/']);
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
                return $this->redirect(['decoracion/']);

            }else{
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el producto.");
                return $this->refresh();
            }
        }

       $producto->cargarDatos($id);
       $variantes = new VarianteDecoracion();

       $fotos_colores = new FotoColor();

       return $this->render('update', [
           'producto' => $producto,
           'categorias' => ArrayHelper::map(Categoria::find()->where(['clave' => 'DECO'])->all(), 'id', 'nombre'),
           'sexos' => ArrayHelper::map(Sexo::find()->all(), 'id', 'sexo'),
           'tallas' => ArrayHelper::map(Talla::find()->orderBy(['orden'=>SORT_ASC])->all(), 'id', 'talla'),
           'tipos' => ArrayHelper::map(Tipo::find()->all(), 'id', 'nombre'),
           'colores' => ArrayHelper::map(ColorDecoracion::find()->orderBy(['color'=>SORT_ASC])->all(), 'id', 'color'),
           'medidas' => ArrayHelper::map(Medidas::find()->all(), 'id', 'medidas'),
           'variantes' => $variantes->variantesProducto($id),
           'fotos_color' => $fotos_colores->fotos($id)
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

    function actionColores(){
        $searchModel = new ColorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('colores', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    function actionAgregarColor(){
        $form = new ColorForm();
        if ($form->load(Yii::$app->request->post())) {
            if($form->guardar()){
                Yii::$app->session->setFlash('success', "El color se guardó correctamente");
            }else{
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el color");
            }
            return $this->redirect(['decoracion/colores']);
        }else{
            return $this->render('agregar_color',[
                'color' => $form
            ]);
        }
    }

    function actionActualizarColor($id){
        $form = new ColorForm();
        if ($form->load(Yii::$app->request->post())) {
            if($form->actualizar()){
                Yii::$app->session->setFlash('success', "El color se guardó correctamente");
            }else{
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar el color");
            }
            return $this->redirect(['decoracion/colores']);
        }else{
            $color = ColorDecoracion::findOne($id);
            $form->id = $color->id;
            $form->color = $color->color;
            return $this->render('actualizar_color',[
                'color' => $form
            ]);
        }
    }

    function actionMedidas(){
        $searchModel = new MedidasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('medidas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    function actionAgregarMedida(){
        $form = new MedidaForm();
        if ($form->load(Yii::$app->request->post())) {
            if($form->guardar()){
                Yii::$app->session->setFlash('success', "La medida se guardó correctamente");
            }else{
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar la medida");
            }
            return $this->redirect(['decoracion/medidas']);
        }else{
            return $this->render('agregar_medida',[
                'medida' => $form
            ]);
        }
    }

    function actionActualizarMedida($id){
        $form = new MedidaForm();
        if ($form->load(Yii::$app->request->post())) {
            if($form->actualizar()){
                Yii::$app->session->setFlash('success', "La medida se guardó correctamente");
            }else{
                Yii::$app->session->setFlash('error', "Ocurrió un error al guardar la medida");
            }
            return $this->redirect(['decoracion/medidas']);
        }else{
            $medida = Medidas::findOne($id);
            $form->id = $id;
            $form->medida = $medida->medidas;
            return $this->render('actualizar_medida',[
                'medida' => $form
            ]);
        }
    }

    function actionVariantes(){
        return $this->render('variantes');
    }
}
