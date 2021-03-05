<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

use app\models\Producto;
use app\models\Precio;
use app\models\Foto;
use app\models\FotoColor;
use app\models\Talla;
use app\models\TallaProducto;
use app\models\Categoria;
use app\models\ProductoTipo;
use app\models\VarianteDecoracion;



/**
 * ContactForm is the model behind the contact form.
 */
class ProductoForm extends Model
{
    public $id;
    public $categoria;
    public $nombre;
    public $sexo;
    public $descripcion;
    public $descripcion_breve;
    public $precio;
    public $tallas;
    public $fotos;
    public $fotos_upd;
    public $fotos_elim;
    public $status;
    public $must_have;
    public $fb_id;
    public $sku;
    public $ean;
    public $tipos;
    public $thumb;
    public $precio_descuento;
    public $precio_usd;
    public $precio_descuento_usd;
    public $sold;

    public $colores;
    public $medidas;
    public $precios_variante;
    public $precios_usd_variante;
    public $ids_variantes;

    public $imagen_color;
    public $ids_imagen_color;
    public $imagen_color_ruta;

    private $transaction;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'descripcion_breve', 'precio','precio_descuento', 'precio_usd', 'precio_descuento_usd','categoria', 'tallas', 'status'], 'required'],
            [['nombre', 'descripcion','status'], 'string'],
            [['fb_id', 'sku', 'ean'], 'string', 'max' => 45],
            [['categoria', 'sexo', 'must_have', 'sold'], 'integer'],
            [['precio','precio_descuento', 'precio_usd', 'precio_descuento_usd'], 'double'],
            [['thumb'], 'file', 'extensions' => 'png, jpg'],
            ['tallas', 'each', 'rule' => ['integer']],
            ['tipos', 'each', 'rule' => ['integer']],
            ['fotos', 'each', 'rule' => ['file']],
            ['colores', 'each', 'rule' => ['integer']],
            ['medidas', 'each', 'rule' => ['integer']],
            ['precios_variante', 'each', 'rule' => ['double']],
            ['precios_usd_variante', 'each', 'rule' => ['double']],
            ['ids_variantes', 'each', 'rule' => ['integer']],
            ['ids_imagen_color', 'each', 'rule' => ['integer']],
            ['imagen_color', 'each', 'rule' => ['integer']],
            ['imagen_color_ruta', 'each', 'rule' => ['file']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'categoria' => 'Categoría',
            'precio' => 'Precio',
            'precio_descuento' => 'Precio de Descuento',
            'precio_usd' => 'Precio USD',
            'precio_descuento_usd' => 'Precio de Descuento USD',
            'nombre' => 'Nombre del producto',
            'descripcion' => 'Descripción',
            'fb_id' => 'Facebook ID',
            'sku' => 'SKU',
            'ean' => 'EAN',
            'sold' => 'Sold Out',
            'must_have' => 'Best Seller'
        ];
    }

    public function guardar(){
        $connection = \Yii::$app->db;
        $this->transaction = $connection->beginTransaction();

        $producto = new Producto();
        $producto->status = 1;
        $producto->nombre = $this->nombre;
        $producto->descripcion = $this->descripcion;
        $producto->descripcion_breve = $this->descripcion_breve;
        $producto->categoria_id = $this->categoria;
        if(!$this->sexo){
            $producto->sexo_id = 1;
        }else{
            $producto->sexo_id = $this->sexo;
        }
        $producto->must_have = $this->must_have;
        $producto->id_facebook = $this->fb_id;
        $producto->sku = $this->sku;
        $producto->ean = $this->ean;
        $this->thumb = UploadedFile::getInstance($this, 'thumb');
        if($this->thumb){
            $thumbRoute = $this->guardaThumb();
            if(!$thumbRoute){
                Yii::$app->setFlash('error', 'Error al cargar thumb');
                $this->transaction->rollback();
                return false;
            } else {
                $producto->thumb = $thumbRoute;
            }
        }
        if(!$producto->save()){
            $this->transaction->rollback();
            return false;
        }

        $precio = new Precio();
        $precio->precio = $this->precio;
        $precio->precio_descuento = $this->precio_descuento;
        $precio->precio_usd = $this->precio_usd;
        $precio->precio_descuento_usd = $this->precio_descuento_usd;
        $precio->producto_id = $producto->id;
        if(!$precio->save()){
            $this->transaction->rollback();
            return false;
        }

        $this->id = $producto->id;

        if(!$this->guardaTallas()){
            $this->transaction->rollback();
            return false;
        }

        if(!$this->guardaFotos()){
            $this->transaction->rollback();
            return false;
        }

        if(!$this->guardaFotosColor()){
            $this->transaction->rollback();
            return false;
        }

        if (!$this->guardaTipos()) {
            $this->transaction->rollback();
            return false;
        }

        if (!$this->guardaVariantes()) {
            $this->transaction->rollback();
            return false;
        }

        $this->transaction->commit();
        return true;
    }

    public function actualizar($id){
        $connection = \Yii::$app->db;
        $this->transaction = $connection->beginTransaction();

        $precio = Precio::find()->where('producto_id='.$id)->one();
        $precio->precio = $this->precio;
        $precio->precio_descuento = $this->precio_descuento;
        $precio->precio_usd = $this->precio_usd;
        $precio->precio_descuento_usd = $this->precio_descuento_usd;
        if(!$precio->save()){
            $this->transaction->rollback();
            return false;
        }

        $producto = Producto::findOne($id);
        $this->id = $producto->id;
        $producto->nombre = $this->nombre;
        $producto->descripcion = $this->descripcion;
        $producto->descripcion_breve = $this->descripcion_breve;
        $producto->categoria_id = $this->categoria;
        if(!$this->sexo){
            $producto->sexo_id = 1;
        }else{
            $producto->sexo_id = $this->sexo;
        }
        $producto->must_have = $this->must_have;
        $producto->id_facebook = $this->fb_id;
        $producto->sku = $this->sku;
        $producto->ean = $this->ean;
        $this->thumb = UploadedFile::getInstance($this, 'thumb');
        if($this->thumb){
            $thumbRoute = $this->guardaThumb();
            if(!$thumbRoute){
                Yii::$app->setFlash('error', 'Error al cargar thumb');
                $this->transaction->rollback();
                return false;
            } else {
                $producto->thumb = $thumbRoute;
            }
        }
        if(!$producto->save()){
            $this->transaction->rollback();
            return false;
        }

        if(!$this->actualizaTallas()){
            $this->transaction->rollback();
            return false;
        }

        if (!$this->actualizaTipos()) {
            $this->transaction->rollback();
            return false;
        }

        if(isset($this->fotos_elim))
        {
            if(!$this->actualizaFotos()){
                $this->transaction->rollback();
                return false;
            }
        }

        if(isset($this->fotos))
        {
            if(!$this->guardaFotos()){
                $this->transaction->rollback();
                return false;
            }
        }

        if(!$this->actualizaFotosColor()){
            $this->transaction->rollback();
            return false;
        }

        if(!$this->guardaFotosColor()){
            $this->transaction->rollback();
            return false;
        }

        if(!$this->actualizarVariantes()){
            $this->transaction->rollback();
            return false;
        }

        $this->transaction->commit();
        return true;
    }

    public function actualizaFotos()
    {
        if(is_array($this->fotos_elim)){
            foreach($this->fotos_elim as $id_foto)
            {
                if(!Foto::find()->where('foto.id='.$id_foto)->one()->delete())
                {
                    return false;
                }
            }
        }
        return true;
    }

    public function guardaFotos(){
        $this->fotos = UploadedFile::getInstances($this, 'fotos');
        if(is_array($this->fotos)){
            foreach($this->fotos as $i => $foto){
                if($foto){
                    $ruta = Yii::getAlias('@backend/web/images/').'productos/'.preg_replace("/[^a-z0-9\.]/", "", strtolower($this->nombre));
                    $ruta_frontend = Yii::getAlias('@frontend/web/images/').'productos/'.preg_replace("/[^a-z0-9\.]/", "", strtolower($this->nombre));
                    if(!file_exists($ruta)){
                        if(!mkdir($ruta)){
                            return false;
                        }
                    }

                    if(!file_exists($ruta_frontend)){
                        if(!mkdir($ruta_frontend)){
                            return false;
                        }
                    }
                    $guardado = false;
                    while(!$guardado){
                        $timestamp = time();
                        $nombre_archivo = $timestamp.preg_replace("/[^a-z0-9\.]/", "", strtolower($foto->name));
                        if(!file_exists($ruta.'/'.$nombre_archivo)){
                            if(!$foto->saveAs($ruta.'/'.$nombre_archivo, false )){
                                return false;
                            }
                            if(!$foto->saveAs($ruta_frontend.'/'.$nombre_archivo, false )){
                                return false;
                            }
                            $guardado = true;
                        }
                    }
                    $foto = new Foto();
                    $foto->archivo = 'productos/'.preg_replace("/[^a-z0-9\.]/", "", strtolower($this->nombre)).'/'.$nombre_archivo;
                    $foto->producto_id = $this->id;
                    if(!$foto->save()){
                        return false;
                    }
                }
            }
        }
        return true;
    }

    public function guardaThumb(){
        $ruta = Yii::getAlias('@backend/web/images/').'productos/thumbs';
        $ruta_frontend = Yii::getAlias('@frontend/web/images/').'productos/thumbs';
        $guardado = false;
        while(!$guardado){
            $timestamp = time();
            $nombre_archivo = $timestamp.preg_replace("/[^a-z0-9\.]/", "", strtolower($this->thumb->name));
            if(!file_exists($ruta.'/'.$nombre_archivo)){
                if(!$this->thumb->saveAs($ruta.'/'.$nombre_archivo, false )){
                    return false;
                }
                if(!$this->thumb->saveAs($ruta_frontend.'/'.$nombre_archivo, false )){
                    return false;
                }
                $guardado = true;
            }
        }
        return 'productos/thumbs/'.$nombre_archivo;
    }

    private function guardaTallas(){
        if($this->tallas){
            if(is_array($this->tallas)){
                foreach($this->tallas as $talla){
                    $talla_producto = new TallaProducto();
                    $talla_producto->talla_id = $talla;
                    if (!empty($this->sold)){
                        $search = array_search($talla, $this->sold);
                        if ( $search !== false ){
                            $talla_producto->sold = 1;
                        } else {
                            $talla_producto->sold = 0;
                        }
                    }

                    $talla_producto->producto_id = $this->id;
                    if(!$talla_producto->save()){
                        return false;
                    }
                }
            }
        }
        return true;
    }

    private function actualizaTallas(){
        if($this->tallas){
            $tallas = TallaProducto::find()->where('talla_producto.producto_id='.$this->id)->all();
            foreach($tallas as $talla)
            {
                $talla->delete();
            }
            if(is_array($this->tallas)){
                foreach($this->tallas as $talla){
                    $talla_producto = new TallaProducto();
                    $talla_producto->talla_id = $talla;
                    if (!empty($this->sold)){
                        $search = array_search($talla, $this->sold);
                        if ( $search !== false ){
                            $talla_producto->sold = 1;
                        } else {
                            $talla_producto->sold = 0;
                        }
                    }

                    $talla_producto->producto_id = $this->id;
                    if(!$talla_producto->save()){
                        return false;
                    }
                }
            }
        }
        return true;
    }

    private function guardaColores(){
        if(is_array($this->colores)){
            foreach($this->colores as $color){
                $color_producto = new ColorProducto();
                $color_producto->color_id = $color;
                $color_producto->producto_id = $this->id;
                if(!$color_producto->save()){
                    return false;
                }
            }
        }
        return true;
    }

    private function actualizaColores(){
        $colores = ColorProducto::find()->where('color_producto.producto_id='.$this->id)->all();
        foreach($colores as $color)
        {
            $color->delete();
        }
        if(is_array($this->colores)){
            foreach($this->colores as $color){
                $color_producto = new ColorProducto();
                $color_producto->color_id = $color;
                $color_producto->producto_id = $this->id;
                if(!$color_producto->save()){
                    return false;
                }
            }
        }
        return true;
    }

    private function guardaTipos() {
        if (is_array($this->tipos)) {
            foreach ($this->tipos as $tipo) {
                $productoTipo = new ProductoTipo();
                $productoTipo->producto_id = $this->id;
                $productoTipo->tipo_id = $tipo;
                if (!$productoTipo->save()) {
                    return false;
                }
            }
        }
        return true;
    }

    private function actualizaTipos() {
        $tipos = ProductoTipo::find()->where(['producto_id' => $this->id])->all();
        foreach ($tipos as $tipo) {
            $tipo->delete();
        }
        if (is_array($this->tipos)) {
            foreach ($this->tipos as $tipo) {
                $productoTipo = new ProductoTipo();
                $productoTipo->producto_id = $this->id;
                $productoTipo->tipo_id = $tipo;
                if (!$productoTipo->save()) {
                    return false;
                }
            }
        }
        return true;
    }

    public function cargarDatos($id){
        $producto = Producto::findOne($id);

        $this->id = $id;
        $this->categoria = $producto->categoria_id;
        $this->sexo = $producto->sexo_id;
        $this->nombre = $producto->nombre;
        $this->status = $producto->status;
        $this->descripcion = $producto->descripcion;
        $this->descripcion_breve = $producto->descripcion_breve;
        $this->must_have = $producto->must_have;
        $this->fb_id = $producto->id_facebook;
        $this->sku = $producto->sku;
        $this->ean = $producto->ean;
        $this->thumb = $producto->thumb;
        $precio = Precio::find()->where('producto_id='.$producto->id)->one();
        $this->precio = $precio->precio;
        $precio_descuento = Precio::find()->where('producto_id='.$producto->id)->one();
        $this->precio_descuento = $precio_descuento->precio_descuento;
        $precio_usd = Precio::find()->where('producto_id='.$producto->id)->one();
        $this->precio_usd = $precio_usd->precio_usd;
        $precio_descuento_usd = Precio::find()->where('producto_id='.$producto->id)->one();
        $this->precio_descuento_usd = $precio_descuento_usd->precio_descuento_usd;
        $tallas = TallaProducto::find()->where('talla_producto.producto_id='.$id)->all();

        $this->tallas=array();
        $this->sold=array();
        foreach($tallas as $talla)
        {
            array_push($this->tallas, $talla->talla_id);
            if ($talla->sold) {
                array_push($this->sold, $talla->talla_id);
            }
        }
        $tipos = ProductoTipo::find()->where(['producto_id' => $id])->all();
        $this->tipos = array();
        foreach ($tipos as $tipo) {
            array_push($this->tipos, $tipo->tipo_id);
        }
        $fotos = Foto::find()->where('foto.producto_id='.$id)->all();
        $this->fotos_upd= $fotos;
    }

    private function actualizarVariantes(){
        if(is_array($this->colores)){
            if(count($this->colores)){
                foreach ($this->colores as $index => $color) {
                    if($color && $this->medidas[$index] && $this->precios_variante[$index] && $this->precios_usd_variante[$index]){
                        if($this->ids_variantes[$index]){
                            $variante = VarianteDecoracion::findOne($this->ids_variantes[$index]);
                        }else{
                            $variante = new VarianteDecoracion();
                        }
                        $variante->producto_id = $this->id;
                        $variante->color_decoracion_id = $color;
                        $variante->medidas_id = $this->medidas[$index];
                        $variante->precio = $this->precios_variante[$index];
                        $variante->precio_usd = $this->precios_usd_variante[$index];
                        if(!$variante->save()){
                            return false;
                        }
                    }else{
                        if($this->ids_variantes[$index]){
                            $variante = VarianteDecoracion::findOne($this->ids_variantes[$index]);
                            $variante->delete();
                        }
                    }
                }
            }
        }
        return true;
    }

    private function guardaVariantes(){
        if(is_array($this->colores)){
            if(count($this->colores)){
                foreach ($this->colores as $index => $color) {
                    if($color && $this->medidas[$index] && $this->precios_variante[$index] && $this->precios_usd_variante[$index]){
                        $variante = new VarianteDecoracion();
                        $variante->color_decoracion_id = $color;
                        $variante->medidas_id = $this->medidas[$index];
                        $variante->producto_id = $this->id;
                        $variante->precio = $this->precios_variante[$index];
                        $variante->precio_usd = $this->precios_usd_variante[$index];
                        if(!$variante->save()){
                            return false;
                        }
                    }
                }
            }
        }
        return true;
    }

    public function guardaFotosColor(){
        if (is_array($this->imagen_color)){
            foreach ($this->imagen_color as $index => $color) {
                $foto_color = UploadedFile::getInstance($this, 'imagen_color_ruta['.$index.']');
                if($foto_color && $color){
                    $ruta = Yii::getAlias('@backend/web/images/').'productos/'.preg_replace("/[^a-z0-9\.]/", "", strtolower($this->nombre));
                    $ruta_frontend = Yii::getAlias('@frontend/web/images/').'productos/'.preg_replace("/[^a-z0-9\.]/", "", strtolower($this->nombre));
                    if(!file_exists($ruta)){
                        if(!mkdir($ruta)){
                            return false;
                        }
                    }

                    if(!file_exists($ruta_frontend)){
                        if(!mkdir($ruta_frontend)){
                            return false;
                        }
                    }
                    $guardado = false;
                    while(!$guardado){
                        $timestamp = time();
                        $nombre_archivo = $timestamp.preg_replace("/[^a-z0-9\.]/", "", strtolower($foto_color->name));
                        if(!file_exists($ruta.'/'.$nombre_archivo)){
                            if(!$foto_color->saveAs($ruta.'/'.$nombre_archivo, false )){
                                return false;
                            }
                            if(!$foto_color->saveAs($ruta_frontend.'/'.$nombre_archivo, false )){
                                return false;
                            }
                            $guardado = true;
                        }
                    }
                    $foto = new FotoColor();
                    $foto->archivo = 'productos/'.preg_replace("/[^a-z0-9\.]/", "", strtolower($this->nombre)).'/'.$nombre_archivo;
                    $foto->producto_id = $this->id;
                    $foto->color_decoracion_id = $color;
                    if(!$foto->save()){
                        return false;
                    }
                }
            }
        }
        return true;
    }

    public function actualizaFotosColor(){
        if (is_array($this->imagen_color)){
            foreach ($this->imagen_color as $index => $color) {
                if($color == '' && isset($this->ids_imagen_color[$index])){
                    $foto = FotoColor::findOne($this->ids_imagen_color[$index]);
                    if(!$foto->delete()){
                        return false;
                    }
                }
            }
        }
        return true;
    }
}
