<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Expression;
use app\models\Producto;
use app\models\Categoria;
use app\models\Talla;
use app\models\Pageview;
use frontend\models\ProductoForm;
use frontend\models\PersonalizadaForm;
use frontend\models\CustomPhotoForm;
use frontend\models\ReviewForm;
use frontend\models\SoldCorreoForm;
use app\models\ContenidoBombers;
use app\models\VarianteDecoracion;
use app\models\ColorDecoracion;
use app\models\Medidas;
use yii\helpers\ArrayHelper;

class DecoracionController extends Controller
{

    public function actionIndex(){
        $soldCorreo = new SoldCorreoForm();
        if($soldCorreo->load(Yii::$app->request->post())){
            if($soldCorreo->guardar()){
                Yii::$app->session->setFlash('success', "Nos comunicaremos contigo en cuanto este disponible.");
            }
        }
        $productos = new Producto();
        $categoria = Categoria::find()->where(['clave' => 'DECO'])->one();
        $filterBy = Yii::$app->request->get('filterBy');
        return $this->render('index',[
            'productos' => $productos->coleccion('DECO', $filterBy),
            'coleccion' => $categoria->nombre,
            'filterBy' =>$filterBy,
            'soldCorreo' => $soldCorreo,
        ]);
    }

    public function actionVer($id){
        $reviewForm = new ReviewForm();
        if ($reviewForm->load(Yii::$app->request->post())) {
            if ($reviewForm->guardarReview()) {
                Yii::$app->session->setFlash('success', "Reseña recibida. Se pondrá a revisión y posteriormente será publicada.");
            }
        }
        $soldCorreo = new SoldCorreoForm();
        if($soldCorreo->load(Yii::$app->request->post())){
            if($soldCorreo->guardar()){
                Yii::$app->session->setFlash('success', "Nos comunicaremos contigo en cuanto este disponible.");
            }
        }
        $pageView = new Pageview();
        $pageView->producto_id = $id;
        $pageView->save();
        $bomber = Producto::findOne($id);
        $bombersBest = Producto::find()->where(['must_have' => 1, 'status' => 1])->orderBy(['id'=>SORT_DESC])->limit(5)->all();
        $producto = new Producto();
        $producto_form = new ProductoForm();
        $producto_form->producto = $id;
        $producto_form->talla = 1;
        if($bomber->orden > -1){
            $bomberActual = $bomber->orden;
            $bomberNum = count($producto->coleccion(2018));
            $bomberAnterior = Producto::find()
                ->where(['orden' => $bomberActual - 1])
                ->one();
            $bomberSiguiente = Producto::find()
                ->where(['orden' => $bomberActual + 1])
                ->one();
            $sobrantes = [0,1,2,3];
            $bombersFloat = Producto::find()
                ->where(['in', 'orden', [
                    $bomberActual + 1 > $bomberNum - 1 ? array_pop($sobrantes) : $bomberActual+1,
                    $bomberActual + 2 > $bomberNum - 1 ? array_pop($sobrantes) : $bomberActual+2,
                    $bomberActual + 3 > $bomberNum - 1 ? array_pop($sobrantes) : $bomberActual+3,
                    $bomberActual + 4 > $bomberNum - 1 ? array_pop($sobrantes) : $bomberActual+4,
                ]])
                ->andWhere(['status' => 1])
                ->andWhere(['categoria_id' => $bomber->categoria_id])
                ->orderBy(['orden' => SORT_ASC])
                ->limit(4)
                ->all();
        }

        $variante = new VarianteDecoracion();
        $colores = $variante->colores($id);
        return $this->render('ver',[
            'producto' => $producto->datos($id),
            'tallas' => $producto->tallas($id),
            'fotos' => $producto->fotos($id),
            'producto_form' => $producto_form,
            'reviewForm' => $reviewForm,
            'bombersBest' => $bombersBest,
            'bomberPrev' => (isset($bomberAnterior) ? $bomberAnterior->id : false),
            'bomberSig' => (isset($bomberSiguiente) ? $bomberSiguiente->id : false),
            'bomberAct' => (isset($bomberActual) ? $bomberActual : false),
            'bomberNum' => $bomberNum,
            'bombersFloat' => $bombersFloat,
            'pageView' => $pageView,
            'soldCorreo' => $soldCorreo,
            'colores' => ArrayHelper::map($colores,'id','color')
        ]);
    }

    public function actionObtieneMedidas(){
        $variante = new VarianteDecoracion();
        $medidas = $variante->medidas(Yii::$app->request->post('id'), Yii::$app->request->post('color'));
        return $this->renderPartial('_medidas',[
            'medidas' => $medidas
        ]);
    }

    public function actionVerCustom(){
        $reviewForm = new ReviewForm();
        if ($reviewForm->load(Yii::$app->request->post())) {
            if ($reviewForm->guardarReview()) {
                Yii::$app->session->setFlash('success', "Reseña recibida. Se pondrá a revisión y posteriormente será publicada.");
            }
        }
        $soldCorreo = new SoldCorreoForm();
        if($soldCorreo->load(Yii::$app->request->post())){
            if($soldCorreo->guardar()){
                Yii::$app->session->setFlash('success', "Nos comunicaremos contigo en cuanto este disponible.");
            }
        }
        $personalizada = new PersonalizadaForm();
        if ($personalizada->load(Yii::$app->request->post())){
            $producto_personalizado = new Producto();
            $producto_personalizado = $producto_personalizado->personalizada();
            $producto = new ProductoForm();
            $producto->producto = $producto_personalizado->id;
            $producto->diseno = $personalizada->diseno;
            $producto->linea1 = $personalizada->linea1;
            $producto->linea2 = $personalizada->linea2;
            $producto->linea3 = $personalizada->linea3;
            $producto->imagen_personalizada = $personalizada->imagen;
            $bombersBest = Producto::find()->where(['must_have' => 1, 'status' => 1])->orderBy(['id'=>SORT_DESC])->limit(5)->all();
            return $this->render('ver_personalizada',[
                'personalizacion' => $personalizada,
                'producto_form' => $producto,
                'producto' => $producto_personalizado,
                'fotos' => $producto_personalizado->fotos($producto_personalizado->id),
                'tallas' => $producto_personalizado->tallas($producto->producto),
                'bombersBest' => $bombersBest,
                'reviewForm' => $reviewForm,
                'soldCorreo' => $soldCorreo,
            ]);
        }
        return $this->redirect(['personalizacion/']);
    }

    public function actionPersonaliza(){
        return $this->render('personaliza');
    }

    public function actionHopebox(){
        return $this->render('hopebox');
    }

    public function actionPersonalizacion(){
        /*$producto = new Producto();
        $producto = $producto->altaPersonalizacion();
        return $this->render('personalizacion',[
            'id' => $producto->id
        ]);*/

           $reviewForm = new ReviewForm();
        if ($reviewForm->load(Yii::$app->request->post())) {
            if ($reviewForm->guardarReview()) {
                Yii::$app->session->setFlash('success', "Reseña recibida. Se pondrá a revisión y posteriormente será publicada.");
            }
        }
        $photoForm = new CustomPhotoForm();
        if($photoForm->load(Yii::$app->request->post())){

            if($photoForm->guardar()){
                Yii::$app->session->setFlash('success', 'El archivo ' . $photoForm->fotoCustom->name . ' se cargo correctamente');
                $producto = new Producto();
                $producto = $producto->altaPersonalizacion();
                $producto_form = new ProductoForm();
                $producto_form->producto = $producto->id;
                $producto_form->comentarios = $photoForm->comentarios;
                $bombersBest = Producto::find()->where(['must_have' => 1, 'status' => 1])->orderBy(['id'=>SORT_DESC])->limit(5)->all();
                $soldCorreo = new SoldCorreoForm();
//                if($soldCorreo->load(Yii::$app->request->post())){
//                    if($soldCorreo->guardar()){
//                        Yii::$app->session->setFlash('success', "Nos comunicaremos contigo en cuanto este disponible.");
//                    }
//                }
                return $this->render('ver', [
                    'soldCorreo' => $soldCorreo,
                    'producto' => $producto->datos($producto->id),
                    'tallas' => $producto->tallas($producto->id),
                    'fotos' => $producto->fotos($producto->id),
                    'producto_form' => $producto_form,
                    'reviewForm' => $reviewForm,
                    'bombersBest' => $bombersBest,
                    'photoForm' =>  $photoForm,
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Error cargando foto');
            }
        }
        $photoForm = new CustomPhotoForm();
         return $this->render('personalizacion', [
            'photoForm' => $photoForm
        ]);
    }

    public function actionAgregaCarrito(){
        if(Yii::$app->request->isAjax){
            /*Agregar al carrito*/
            $color = ColorDecoracion::findOne(Yii::$app->request->post('color_decoracion'));
            $medidas = Medidas::findOne(Yii::$app->request->post('medidas_decoracion'));
            $decoracion = [
                'color' => $color->color,
                'medidas' => $medidas->medidas,
                'costo' => Yii::$app->request->post('costo_variante')
            ];
            return json_encode(\Yii::$app->Carrito->agregar(
                Yii::$app->request->post('producto'),
                Yii::$app->request->post('talla'),
                Yii::$app->request->post('cantidad'),
                Yii::$app->request->post('comentarios'),
                null,
                Yii::$app->request->post('foto_id'),
                $decoracion
            ));
        }else{
            /*Comprar*/
            $producto = new ProductoForm();
            if($producto->load(Yii::$app->request->post())){
                if($producto->agregar()){
                    return $this->redirect(['checkout/']);
                }
                return $this->refresh();
            }
        }
    }

    public function actionActualizarCarrito(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'numero_productos' => count(Yii::$app->Carrito->obtieneProductos())
        ];
    }

    public function actionBorrarProductoCarrito(){
        $producto = intval(Yii::$app->request->post('producto'));
        $talla = intval(Yii::$app->request->post('talla'));
        return Yii::$app->Carrito->borrarProducto($producto, $talla);
    }

    public function actionTrazos(){
        $reviewForm = new ReviewForm();
        if ($reviewForm->load(Yii::$app->request->post())) {
            if ($reviewForm->guardarReview()) {
                Yii::$app->session->setFlash('success', "Reseña recibida. Se pondrá a revisión y posteriormente será publicada.");
            }
        }
        $photoForm = new CustomPhotoForm();
        if($photoForm->load(Yii::$app->request->post())){

            if($photoForm->guardar()){
                Yii::$app->session->setFlash('success', 'El archivo ' . $photoForm->fotoCustom->name . ' se cargo correctamente');
                $producto = new Producto();
                $producto = $producto->personalizadaFoto($photoForm->elementos);
                $producto_form = new ProductoForm();
                $producto_form->producto = $producto->id;
                $producto_form->comentarios = $photoForm->comentarios;
                $bombersBest = Producto::find()->where(['must_have' => 1, 'status' => 1])->orderBy(['id'=>SORT_DESC])->limit(5)->all();
                $soldCorreo = new SoldCorreoForm();
                return $this->render('ver', [

                    'soldCorreo' => $soldCorreo,
                    'producto' => $producto->datos($producto->id),
                    'tallas' => $producto->tallas($producto->id),
                    'fotos' => $producto->fotos($producto->id),
                    'producto_form' => $producto_form,
                    'reviewForm' => $reviewForm,
                    'bombersBest' => $bombersBest,
                    'photoForm' =>  $photoForm,
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Error cargando foto');
            }
        }
        return $this->render('personalizada_foto', [
            'photoForm' => $photoForm
        ]);
    }

    public function actionAgregaCarritoTrazado(){
        $photoForm = new CustomPhotoForm();
        if($photoForm->load(Yii::$app->request->post())){
            if($photoForm->guardar()){
                $producto = new Producto();
                $producto = $producto->personalizadaFoto($photoForm->elementos);
                return json_encode(\Yii::$app->Carrito->agregar(
                    $producto->id,
                    Yii::$app->request->post('talla'),
                    1,
                    $photoForm->comentarios,
                    null,
                    $photoForm->modelId
                ));
            }
        }
    }

    public function actionObtenerTallasProducto(){
        $elementos = Yii::$app->request->post('elementos');
        $producto = new Producto();
        $producto = $producto->personalizadaFoto($elementos);
        return json_encode($producto->tallas($producto->id));
    }

    public function actionActualizarVisita(){
        $visita = intval(Yii::$app->request->post('visita'));
        $objVisita = Pageview::findOne($visita);
        $objVisita->tiempo_visita += 5;
        $objVisita->update();
        return true;
    }
    public function actionGetDatos(){

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $producto = Producto::find()->where(['id' => Yii::$app->request->post('ProductoForm')['producto']])->one();
        return [
            'exito' => 1,
            'nombre' => $producto->nombre,
            'sku' => $producto->sku,
            'price' => $producto->precios[0]->precio_descuento * Yii::$app->request->post('ProductoForm')['cantidad'],
            'price_unidad' => $producto->precios[0]->precio_descuento,
            'brand' => 'VOCAMX',
            'categoria' => 'Decoracion',
            'variante' => 'Decoracion',
            'cantidad' => Yii::$app->request->post('ProductoForm')['cantidad'],
        ];

    }
}
