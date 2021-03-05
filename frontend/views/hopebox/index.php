<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div id="bloque-header"></div>
<section class="container" id="hopebox">
    <div class="row">
        <div class="col-12" id="hope-head">
            <div class="row" style="padding: 50px 0px">
                <div class="col-xs-offset-1 col-xs-6 col-sm-offset-2 col-sm-5" id="interior1-hope-head" >
                    <h1 id="titulo-hopebag">HOPEBAG</h1>
                    <h3 id="subtitulo-hopebag">02019</h3>
                    <h2 style="color:#ff0000" class="bottom-0">cenicereo portátil</h2>
                    <h3 style="margin:0 0 25px;">Para fumadores y no fumadores</h3>
                    <p>Las colillas son la primer fuente de basura en el mundo</p>
                    <p>Ayudános a hacerlo llegar a más personas</p>
                    <div class="row botones-hopebag">
                        <div class="col-xs-12 col-md-6">
                            <a href="<?= Url::to(['bombers/ver', 'id' => '113']) ?>" id="hopebox-boton-rojo" target="">Contribuir</a>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <h3 id="precio-hope-head">Precio: 3pzs x $270</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5 col-md-4 " id="interior2-hope-head" >
                   <?= Html::img('@web/images/hopebox/FrenteRetocado.png',[ 'class' => 'img-responsive' ]) ?>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row" id="hopebox-body1">
        <div class="col-12"><h2 class="bottom-0 text-center" style="color:#ff0000">Conoce más del problema</h2></div>
        <div class="col-12"><h3  class="text-center">Colillas de cigarro</h3></div>
        
        <div class="col-md-offset-2 col-md-8">
            <div class="row">
                <div class="col-sm-4 hope-tarjeta">
                    <?= Html::img('@web/images/hopebox/Tproblema.jpg',['class' => 'img-responsive']) ?>
                    <h3 style="color:#ff0000">Tamaño del problema</h3>
                    <p><strong>Muchos aún no lo saben</strong></p>
                    <p>Es la mayor fuente de basura del mundo superando al problema de plásticos o popotes</p>
                    <p><strong>No se habla mucho del tema</strong></p>
                    <p>No existe actualmente una iniciativa que controle el problema</p>
                    <p><strong>Sigue creciendo</strong></p>
                    <p>Los fumadores crecen cada año</p>
                </div> 
                <div class="col-sm-4 hope-tarjeta">
                    <?= Html::img('@web/images/hopebox/hopebox-el-problema2.jpg', ['class' => 'img-responsive']) ?>
                    <h3 style="color:#ff0000">Impacto en el mundo</h3>
                    <p><strong>Mares y ríos</strong></p>   
                    <p>1 colilla contamina de 8 - 10 lts este pequeño residuo es una bomba toxica</p>
                    <p><strong>Tierra envenenada</strong></p>
                    <p>Disminuyendo su fertilidad contaminando los frutos y los procesos de purificación</p>
                    <p><strong>fauna marina</strong></p>
                    <p>Intoxicando peces que pueden morir o que terminamos ingiriendo</p> 
                </div> 
                <div class="col-sm-4 hope-tarjeta">
                    <?= Html::img('@web/images/hopebox/PropuestaVocaMx.jpg', ['class' => 'img-responsive']) ?>
                    <h3 style="color:#ff0000">Propuesta Vocamx</h3>
                    <p><strong>Hacer una cadena por esta causa</strong></p>
                    <p>Si fumas úsalo y si no fumas hazlo llegar a quien pueda servirle en cada paquete encontrarás 3 ceniceros</p>
                    <p><strong>Proteger los puntos mas vulnerables</strong></p>
                    <p>Ser más cuidadosos en playas y ríos donde es el mayor impacto llevando el cenicero a esos lugares</p>
                    <p><strong>Sembrar en nuestra comunidad</strong></p>
                    <p>Darle visibilidad a este gran problema un pequeño cambio con gran impacto</p>
                </div> 
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row" id="hopebox-body2">
        <div class="col-12">
            <h1 id="titulo-hopebag">HOPEBAG</h1>
            <h3 id="subtitulo-hopebag">02019</h3></div>
        <div class="col-12"><h3  class="text-center" style="color:#333333">Cenicero portátil reutilizable</h3></div>
        <div class="col-md-offset-1 col-md-10">
            <div class="row">
                <div class="col-sm-7 col-xs-12 ">
                    <?= Html::img('@web/images/hopebox/HopeBagFrente.jpg', ['class' => 'hope-body2-images hope-img', 'id' => 'hope-img1']) ?>
                </div> 
                <div class="col-sm-5 col-xs-12 ">
                    <div class="row">
                        <div class="col-xs-6 col-sm-12">
                            <?= Html::img('@web/images/hopebox/hopeBagDerA.jpg',['class' => 'img-responsive hope-body2-images']) ?>
                        </div> 
                        <div class="col-xs-6 col-sm-12">
                            <?= Html::img('@web/images/hopebox/hopeBagDerDown.jpg',['class' => 'img-responsive hope-body2-images']) ?>
                        </div>                         
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12 col-md-offset-2 col-md-8 col-xl-offset-4 col-xl-4">
                    <div class="row beneficios-hope ">
                        <div class="col-xs-6 col-sm-4 parrafo">
                            <h3>Buen almacenaje</h3>
                            <p>24 piezas max / 1 cajetilla</p>
                        </div>
                        <div class="col-xs-6 col-sm-4 parrafo">
                            <h3>Tamaño Cómodo</h3>
                            <p>8 x 8 cm</p>
                            <p>Cómodo para transportar en el bolsillo</p>
                        </div>
                        <div class="col-xs-6 col-sm-4 parrafo">
                            <h3>Sellado seguro</h3>
                            <p>Manitiene el aroma y cenizas del cigarro dentro del cenicero</p>
                        </div>
                        <div class="col-xs-6 col-sm-4 parrafo">
                            <h3>Reutilizable</h3>
                            <p>Fabricado en PVC</p>
                            <p>Repelente al agua</p>

                        </div>
                        <div class="col-xs-6 col-sm-4 parrafo">
                            <h3>Interior resistente</h3>
                            <p>Interior metalizado para una mayor durabilidad (no vaciar colillas prendidas)</p>
                        </div>
                        <div class="col-xs-6 col-sm-4 parrafo">
                            <h3>Fácil limpieza</h3>
                            <p>Solo vacíalo en la basura </p>
                            <p>Puedes limpiarlo con una servilleta</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-12" id="hope-foot">
            <div class="row">
                <div class="col-md-12 center-block" id="interior1-hope-foot">
                    <br>
                    <br>
                    <?= Html::img('@web/images/aguilaMexa.png', ['id' => 'hope-imagen1-foot'])  ?>
                    <h1>Únete a nosotros</h1>
                    <br> 
                    <br>
                    <h3>Usa este cenicero portátil reutilizable</h3>
                    <h3>O regálalo a quien pueda contribuir con este cambio</h3>
                    <br>
                    <a href="<?= Url::to(['bombers/ver', 'id' => '113']) ?>" id="hopebox-boton-rojo2" target="">Contribuir</a>
                    <br>
                    <br>
                    <h2>Precio: 3 pzs x $270</h2>
                    <br>
                    <div class="row float-foot">
                        <div class="col-xs-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
