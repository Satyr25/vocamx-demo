<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\assets\LazyAsset;
    use app\models\Producto;
    use app\models\Categoria;

LazyAsset::register($this);

$form = ActiveForm::begin([
    'id' => 'personaliza-form',
    'action' => ['personalizacion', 'photo' => 'true']
    ])
?>
<div class="fullscreen" id="alta-personalizacion">
    <div class="contenedor visible-sm visible-xs">
        <div id="texto-personalizacion">
                <div class="text-center visible-sm visible-xs franja-crea">
               <span class="text-left">
                <img class="imagen-diamante lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/diamante.png', true)?>" >
                Diseño Exclusivo</span>
                </div>
        </div>
    </div>
    <div class="bloque-crea visible-sm visible-xs">
        <div class="bloque-crea-mobile row">
            <div class="col-sm-12col-xs-2 text-center" id="texto-piensa">
                <span class="texto-gustaria">SÓLO PIENSA <br> QUÉ TE GUSTARÍA</span><br>
                <span class="texto-ilustramos">ILUSTRAMOS TU IDEA</span><br>
                <span class="texto-recibe">RECIBE 10 - 15 DÍAS</span><br>
                <img class="img-marca lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/marcaRoja.png', true)?>" >
            </div>
       </div>
   </div>
   <div class="bloque-ayuda visible-sm visible-xs">
        <div class="imagen-chica2">
                <img class="imagen-chica2 lazy-load" data-src="<?= Url::to('@web/images/alta_personalizacion/fotobloque2.jpg', true) ?>">
        </div>
        <div class="col-md-5" >
                <a href="https://m.me/VocaMXoficial?tr=529281824267405" target="_blank" class="btn-ayuda-alta asistencia-messenger hidden-lg hidden-md">
                <span>AYUDA EN LÍNEA</span><br>
            </a>
        </div>
        <div class="bloque-dudas">
         <div class="visible-sm visible-xs text-center franja-comenzar">
            <span class="texto-dudas">SI TIENES DUDAS DE CÓMO HACER TU CHAMARRA</span>
        </div>
    </div>
   </div>
    <div class="contenedor visible-sm visible-xs">
        <div class="bloque-crea-mobile">
            <span class=" visible-sm visible-xs franja-creanosotros text-center">CREA CON NOSOTROS</span>
        </div>
    </div>
    <div class="bloque-ilustracion visible-sm visible-xs">
        <div class="bloque-ilustracion-mobile row">
            <div class="col-sm-6 col-xs-6">
                  <img class="img-creanosotros lazy-load" data-src="<?= Url::to('@web/images/alta_personalizacion/creaconNosotros.jpg', true) ?>" >
            </div>
            <div class="col-sm-6 col-xs-6 text-left bloque-ilustracion-texto" id="texto-ilustracion">

                 <img class="img-logotipovoca lazy-load" data-src="<?= Url::to('@web/images/alta_personalizacion/imagotipoVocamx.png', true) ?>" >
                <label id="texto-ilustra">LA ILUSTRACIÓN ES A MEDIDA Y PUEDES HACER UN CAMBIO</label>
                 <label id="texto-guia">TE GUIAMOS EN LÍNEA PARA QUE SE VEA MUY COOL</label>
                  <label id="texto-dinos">SÓLO DINOS QUE TE GUSTARÍA</label><br>
                   <label id="texto-listo">LISTO! <br> RECIBE 10-15 DÍAS</label>
            </div>
       </div>
   </div>
   <div class="bloque-paquete visible-sm visible-xs">
        <div class="bloque-paquete-mobile">
            <div class="bloque-paquete-mobile row">
                <?php $categoria = Categoria::find()->where("categoria.clave = 'ALPR'")->one();?>
                <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                <div class="titulo-paquete text-center">
                <span class="text-center">PAQUETE INTRODUCCIÓN</span>
                </div>
                <div class="col-sm-3 col-xs-3 text-center" id="texto-ahorro">
                     <label>
                          <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                              $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                          <?php } else { ?>
                              $<?= number_format($producto[0]->precios[0]->precio) ?>
                          <?php } ?>
                     </label><br>
                     <label>MEGA AHORRO:</label><br>
                     <label>
                          <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                              $<?= number_format($producto[0]->precios[0]->precio - $producto[0]->precios[0]->precio_descuento)?>
                          <?php } else { ?>
                              $<?= number_format($producto[0]->precios[0]->precio - $producto[0]->precios[0]->precio)?>
                          <?php }?>
                     </label><br>
                </div>
                <div class="col-sm-4 col-xs-4 text-center" id="texto-incluye">
                     <label>INCLUYE:</label><br>
                      <label>CHAMARRA</label><br>
                      <label>DISEÑO EXCLUSIVO</label><br>
                      <label>ESTAMPADO DE ESPALDA</label><br>
                      <label class="texto-asistencia">ASISTENCIA EN EL PROCESO</label>
                </div>
                <div class="col-sm-2 col-xs-2 text-center bloque-paquete-texto">
                    <span class="texto-gratis">GRATIS</span>
                </div>
                <div class="col-sm-3 col-xs-3 text-center" id="texto-personalizado" >
                      <label id="personalizado">PERSONALIZADO</label><br>
                      <label id="frente">FRENTE,BRAZO,HOMBRO Y ETIQUETA</label><br>
                      <label id="envio-">ENVÍO TODO MÉXICO</label>
                </div>
           </div>
       </div>
       <div class="bloque-granventa">
            <div class="bloque-paquete-mobile row">
                <div class="col-sm-4 col-xs-4 text-center ">

                </div>
                <div class="col-sm-4 col-xs-4 text-center" id="texto-gratis">
                     <span class="envio-gratis">ENVÍO GRATIS</span><br>
                </div>
                <div class="col-sm-4 col-xs-4 text-center">
                    <img class="imagen-introduccion lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/BloquePaqueteIntroduccion.png', true) ?>" >
                </div>
           </div>
       </div>
   </div>
   <div class="bloque-maximo visible-sm visible-xs">
       <div class="bloque-maximo-mobile">
           <div class="titulo-maximo text-center">
                <span class="texto-maximo">LLEGA AL MÁXIMO NIVEL</span>
           </div>
           <div class="col-sm-12 col-xs-12 text-center ">
                  <img class="imagen-maximo lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/maximoNivel.jpg', true )?>" >
           </div>
           <div class="titulo-tiempolimitado text-center">
                <span class="texto-producto">GRATIS EN ESTE PRODUCTO </span><br>
                <span class="texto-limitado">TIEMPO LIMITADO</span>
           </div>
       </div>
   </div>
     <div class="bloque-elige visible-sm visible-xs">
       <div class="bloque-elige-mobile">
           <div class="titulo-elige text-center">
                <span class="texto-elige">ELIGE TU COLOR Y TEXTURA</span>
           </div>
               <div class="titulo-metalico text-center">
                    <span class="texto-metalico">METÁLICO</span>
               </div>
               <div class="bloque-metalico-mobile row">
               <div class="col-sm-3 col-xs-3 text-center metalico">
                    <img class="imagen-metalico lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/metalico/mplateado.png', true)?>" >
                    <span class="texto-sudadera">PLATA</span>
               </div>
               <div class="col-sm-3 col-xs-3 text-center metalico">
                      <img class="imagen-metalico lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/metalico/Untitled-1.png', true) ?>" >
                    <span class="texto-sudadera">ORO</span>
               </div>
               <div class="col-sm-3 col-xs-3 text-center metalico">
                      <img class="imagen-metalico lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/metalico/mrojo.png', true) ?>" >
                    <span class="texto-sudadera">ROJO</span>
               </div>
               <div class="col-sm-3 col-xs-3 text-center metalico">
                      <img class="imagen-metalico lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/metalico/mpalodeRosa.png', true)?>" >
                    <span class="texto-sudadera">ROSA</span>
               </div>
           </div>
       </div>

       <div class="bloque-elige2-mobile ">
               <div class="titulo-terciopelo text-center">
                    <span class="texto-terciopelo">TERCIOPELO</span>
               </div>
            <div class="bloque-terciopelo-mobile row">
               <div class="col-sm-3 col-xs-3 text-center terciopelo">
                    <img class="imagen-terciopelo lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/terciopelo/gris.png', true) ?>" >
                    <span class="texto-sudadera2 lazy-load">GRIS</span>
               </div>
               <div class="col-sm-3 col-xs-3 text-center terciopelo">
                      <img class="imagen-terciopelo lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/terciopelo/tblancoClasico.png', true)?>" >
                    <span class="texto-sudadera2">BLANCO</span>
               </div>
               <div class="col-sm-3 col-xs-3 text-center terciopelo">
                      <img class="imagen-terciopelo lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/terciopelo/Trojo.png', true) ?>" >
                    <span class="texto-sudadera2">ROJO</span>
               </div>
               <div class="col-sm-3 col-xs-3 text-center terciopelo">
                      <img class="imagen-terciopelo lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/terciopelo/TnegroNegro.png', true) ?>" >
                    <span class="texto-sudadera2">NEGRO</span>
               </div>
           </div>
       </div>
       <div class="bloque-elige3-mobile">
            <div class="bloque-fluor-mobile row">
               <div class="col-sm-12 col-xs-12 text-center ">
                      <img class="imagen-fluor lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/edicionlimitada.jpg', true)?>" >
               </div>
           </div>
       </div>
   </div>


<div class="container-fluid imagenes-rk visible-sm visible-xs">
  <div class="titulo-exclusivo text-center">
                <span class="texto-diseños">DISEÑOS EXCLUSIVOS</span>
           </div>
    <div class="container imagenenes-rk">
        <div class="carrusel-rk" id="carrusel-rk" >
                <div>
                   <img class="imagen-carrousel-rk lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im1.jpg', true)?>" >
                    <div class="texto-fondo-rk">
                        <p class="texto-inspi1"><label class="texto-inspirado1">LUIS FERNANDO PEÑA</label></p>
                        <p class="texto-inspi2"><label class="texto-inspirado2">
                        DISEÑO  INSPIRADO  EN  LA CDMX Y UN   ESTILO  MUY  CHILANGO
                        UN PUÑO EN LLAMAS CON EL SÍMBOLO  EMBLEMÁTICO
                        DE LA CIUDAD “UN TROMPO DE  PASTOR”</label></p>
                    </div>
                </div>
               <div>
                <img class="imagen-carrousel-rk lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im2.jpg', true)?>" >
                    <div class="texto-fondo-rk">
                        <p class="texto-inspi1"><label class="texto-inspirado1">SAÚL HERNÁNDEZ</label></p>
                        <p class="texto-inspi2"><label class="texto-inspirado2">
                       DISEÑO  INSPIRADO  EN  SU  FRASE “ESTE ES TU RITUAL RAZA”
                        UN ATRAPASUEÑOS DIRIGIDO POR UN JAGUAR
                        UNA EXPRESIÓN  TRIBAL DE  LA ESENCIA DE SAÚL.
                        </label></p>
                    </div>

                </div>
               <div>
                    <img class="imagen-carrousel-rk lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im3.jpg', true)?>" >
                    <div class="texto-fondo-rk">
                      <p class="texto-inspi1"><label class="texto-inspirado1">ADAN JODOROWSKY</label></p>
                        <p class="texto-inspi2"><label class="texto-inspirado2">
                        DISEÑO  INSPIRADO  EN  SU ÚLTIMO DISCO “ESENCIA SOLAR”
                        LA MÚSICA COMO PROTAGONISTA GESTANDO SU PROYECTO
                        RODEADO DE LUZ  QUE DA ADAN ORIGEN A LA ARMONÍA Y LA VIDA</label></p>
                    </div>
                </div>
                <div>
                    <img class="imagen-carrousel-rk lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im4.jpg', true)?>" >
                    <div class="texto-fondo-rk">
                         <p class="texto-inspi1"><label class="texto-inspirado1">ROCO PACHUCOTE</label></p>
                        <p class="texto-inspi2"><label class="texto-inspirado2">
                        DISEÑO INSPIRADO EN OMETEOTL DIOS DE LA CREACIÓN DIVINO SEÑOR DE LA DUALIDAD</label></p>
                    </div>

                </div>
              <div>
                    <img class="imagen-carrousel-rk lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im5.jpg', true)?>" >
                    <div class="texto-fondo-rk">
                    <p class="texto-inspi1"><label class="texto-inspirado1">CONFIDENCIAL</label></p>
                        <p class="texto-inspi2"><label class="texto-inspirado2">
                        DISEÑO INSPIRADO EN LA PELÍCULA POESÍA SIN FIN LA MARIPOSA COMO PROTAGONISTA DE LA CREACIÓN Y DEL INFINITO EN UN ESTILO RETRO</label></p>
                    </div>

                </div>
                <div>
                    <img class="imagen-carrousel-rk lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im6.jpg', true)?>" >
                    <div class="texto-fondo-rk">
                      <p class="texto-inspi1"><label class="texto-inspirado1">TITO MOLOTOV</label></p>
                        <p class="texto-inspi2"><label class="texto-inspirado2">
                        DISEÑO PURO MEXICAN STYLE INSPIRADO EN EL LETTERING MEXICANO AL ESTILO WILD</label></p>
                    </div>

                </div>
               <div>
                    <img class="imagen-carrousel-rk lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im7.jpg', true)?>" >
                    <div class="texto-fondo-rk">
                     <p class="texto-inspi1"><label class="texto-inspirado1">ARMANDO HERNÁNDEZ</label></p>
                        <p class="texto-inspi2"><label class="texto-inspirado2">
                        DISEÑO MÉXICO ES CHILUDO, UN JUEGO DE PALABRAS QUE REFIERE A LA PICARDÍA DEL MEXICANO</label></p>
                    </div>
                </div>
                <div>
                    <img class="imagen-carrousel-rk lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im8.jpg', true)?>" >
                    <div class="texto-fondo-rk">
                      <p class="texto-inspi1"><label class="texto-inspirado1">FRANCO ESCAMILLA</label></p>
                        <p class="texto-inspi2"><label class="texto-inspirado2">
                        DISEÑO INSPIRADO EN SU ÚLTIMA GIRA "RPM" COMO PROTAGONISTA FRANCO COMO EL DIABLO MAYOR Y LETRAS AL ESTILO WILD</label></p>
                    </div>
                </div>
              <div>
                   <img class="imagen-carrousel-rk lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im9.jpg', true)?>" >
                    <div class="texto-fondo-rk">
                        <p class="texto-inspi1"><label class="texto-inspirado1">SONIDO LÍQUIDO</label></p>
                        <p class="texto-inspi2"><label class="texto-inspirado2">
                        DISEÑO INSPIRADO EN SU LOGOTIPO VINTAGE DE 1999 UN HOMENAJE PARA FESTEJAR EL 20 ANIVERSARIO DE I CREW </label></p>
                    </div>
                </div>
            </div>
        </div>
  </div>


   <div class="bloque-caritas visible-sm visible-xs">
       <div class="bloque-caritas-mobile">
           <div class="bloque-importante-mobile">
               <span class=" visible-sm visible-xs franja-importante1 text-center">IMPORTANTE</span>
               <span class=" visible-sm visible-xs franja-ayudasiguiente1 text-center">PARA LOGRAR UN MEJOR RESULTADO,AYÚDANOS CON LO SIGUIENTE</span>
                <div class="bloque-ayuda2-mobile row">
                    <div class="col-sm-4 col-xs-4">
                          <img class="imagen-clara lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/IdeaClara.png', true) ?>" >
                        <label class="texto-clara text-center">TEN CLARA <br> TU IDEA</label>
                    </div>
                    <div class="col-sm-4 col-xs-4">
                        <img class="imagen-ayuda2 lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/comunicar.png', true) ?>" >
                        <label class="texto-comunicar text-center">PIENSA QUE <br> QUIERES COMUNICAR</label>
                    </div>
                    <div class="col-sm-4 col-xs-4">
                        <img class="imagen-ayuda2 lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/derechos.png', true) ?>" >
                        <label class="texto-derechos1 text-center">NO USAR IMÁGENES CON DERECHOS</label>
                    </div>
               </div>
           </div>
       </div>
   </div>

    <div class="bloque-conoce visible-sm visible-xs">
       <div class="bloque-proceso1-mobile">
           <span class=" visible-sm visible-xs franja-conoce1 text-center">CONOCE NUESTRO PROCESO</span>
       </div>
         <div class="bloque-video1-proceso text-center">
                <a href="https://www.youtube.com/watch?v=Enog-fRLlEQ&feature=youtu.be" class="youtube-link hidden"></a>
                <iframe width="300" height="250" src="https://www.youtube.com/embed/Enog-fRLlEQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    <div class="bloque-formulario visible-sm visible-xs">
            <div class="visible-sm visible-xs text-center franja-comenzar-alta">
            <span class="text-left">¿CÓMO COMENZAR?</span>
            </div>
    </div>

    <?php $form = ActiveForm::begin([
      'id' => 'personaliza-form',
      'action' => ['personalizacion', 'photo' => 'true']
  ]);
    ?>

  <div class="bloque-gris-alta row visible-sm visible-xs">
        <div class="col-md-5" id="sube-foto-bloque-alta">
            <div class="row">
                <div id="sube-foto-alta" class="col-sm-12 col-md-12">
                    <h3 class="text-red text-left">Paso 1:</h3>
                    <div class="row">
                        <div class="col-md-12 flex-center">
                            <label for="<?="fotoCustomMobile"?>" class="btn-accion label-replace-file" id="sube-foto-btn-alta">
                                <?= Html::img('@web/images/personaliza_foto/subeFoto.png', ['class' => 'flecha-sube']) ?>
                                Sube tus imágenes
                            </label>
                            <?= Html::img('@web/images/personaliza_foto/imagen.png', ['class' => 'imagen-subir-alta'])?>
                            <i class="far fa-check-circle" id="subida-exito"></i>
                        </div>
                    </div>
                    <div id="name-file"></div>
                    <div id="imagen-cargada" style="display:none;">
                        <img src="" />
                    </div>
                    <?= $form->field($photoForm, 'fotoCustom')->fileInput(['id' => "fotoCustomMobile"])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="col-md-7" id="info-foto-bloque-alta">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-red text-left" id="paso2-alta">Paso 2:</h3>
                        <div class="textos-personaliza-alta">
                            <?= $form->field($photoForm, 'mensaje')->textarea(['placeholder' => 'EXPLÍCANOS BREVEMENTE TU IDEA NUESTRO ILUSTRADOR SE PONDRÁ EN CONTACTO AL DÍA SIGUIENTE', 'rows' => 3 , 'cols' => 5 ])  -> label(false)?>
                             <?= Html::img('@web/images/personaliza_foto/personaliza.png', ['class' => 'personaliza-img-alta'])?>
                        </div>
                        <div class="textos-menu-alta">
                            <?= $form->field($photoForm, 'menu')->checkboxList(['Espalda' => 'Espalda', 'Frente' => 'Frente', 'Hombro' => 'Hombro','Brazo' => 'Brazo','Etiqueta' => 'Etiqueta' ],['id' => 'checkmenu']) -> label(false) ?>
                        </div>
                          <div class="bloque-incluido">
                                <div class="bloque-incluido-mobile row">
                                   <div class="col-sm-3 col-xs-3 text-center incluido">
                                        <span class="texto-incluido">INCLUÍDO</span>
                                   </div>
                                   <div class="col-sm-2 col-xs-2 text-center incluido">
                                        <span class="texto-incluido"><s>$50</s> GRATIS</span>
                                   </div>
                                   <div class="col-sm-2 col-xs-2 text-center incluido">
                                        <span class="texto-incluido"><s>$50</s> GRATIS</span>
                                   </div>
                                   <div class="col-sm-2 col-xs-2 text-center incluido">
                                        <span class="texto-incluido"><s>$50</s> GRATIS</span>
                                   </div>
                                   <div class="col-sm-3 col-xs-3 text-center incluido">
                                        <span class="texto-incluido"><s>$50</s> GRATIS</span>
                                   </div>
                               </div>
                           </div>
                         <div class="textos-color">
                            <?= $form->field($photoForm, 'color')->dropdownList(['PLATA(METÁLICO)' => 'PLATA(METÁLICO)', 'ORO(METÁLICO)' => 'ORO(METÁLICO)', 'ROJO(METÁLICO)' => 'ROJO(METÁLICO)','ROSA(METÁLICO)' => 'ROSA(METÁLICO)','GRIS(TERCIOPELO)' => 'GRIS(TERCIOPELO)','BLANCO(TERCIOPELO)' => 'BLANCO(TERCIOPELO)', 'ROJO(TERCIOPELO)' => 'ROJO(TERCIOPELO)', 'NEGRO(TERCIOPELO)' => 'NEGRO(TERCIOPELO)'],['placeholder' => 'PERSONALIZA: FECHA,NOMBRE,@INSTAGRAM O FRASE',])?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="bloque-gris2-alta row visible-sm visible-xs">
            <div class="col-md-5" >
                <a href="https://m.me/VocaMXoficial?tr=529281824267405" target="_blank" class="  btn-ayuda-altapersonalizacion asistencia-messenger hidden-lg hidden-md">
                <?= Html::img('@web/images/ayuda.png') ?>&emsp;<span>Ayuda</span><br>
            </a>
            </div>
             <div class="visible-sm visible-xs text-center franja-ayuda-altapersonalizacion">
                <h3 class="text-center" id="texto-asistencia">¿QUIERES ASISTENCIA EN TU PEDIDO?</h3>
            </div>
            <div id="elementos-precio-alta">
                <div id="producto-nuevo-alta">
                     <H3 class="producto-nuevotitulo-alta">PRODUCTOS</H3>
                      <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img-alta'])?> CHAMARRA NEGRA</label><br>
                     <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita'])?> ILUSTRACION A LA MEDIDA</label><br>
                     <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img-alta'])?> CON UN CAMBIO</label><br>
                     <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img-alta'])?> PERSONALIZACIÓN:</label><br>
                     <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita'])?> COLOR PERSONALIZADO</label><br>
                </div>

                <div id="numero-elementos-alta">
                    <?= $form->field($photoForm, 'elementos')->input('number', ['min' => 1, 'max' => 5, 'value' => 1, 'autocomplete' => 'off'])  ?>
                    <input type="hidden" id="precio_base" value="1690" />
                    <input type="hidden" id="precio_base_tachado" value="2115" />
                </div>
                <div id="precio-trazado-alta">
                    <?= $form->field($photoForm, 'precio')->hiddenInput()  ?>
                    <?php $categoria = Categoria::find()->where("categoria.clave = 'ALPR'")->one();?>
                    <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                    <span id="texto-precio-alta">
                        <span id="numero-precio-alta">
                           <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                              $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                          <?php } else { ?>
                              $<?= number_format($producto[0]->precios[0]->precio) ?>
                          <?php } ?>
                        </span>
                    </span>
                    <div class="ahorro-bomber-alta">
                        <span class="title" > MEGA AHORRO: </span><span class="number">
                           <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                              $<?= number_format($producto[0]->precios[0]->precio - $producto[0]->precios[0]->precio_descuento)?>
                          <?php } else { ?>
                              $<?= number_format($producto[0]->precios[0]->precio - $producto[0]->precios[0]->precio)?>
                          <?php }?>
                        </span>
                    </div>
                    <div class="dia-entrega-alta">
                        <span class="title">PERSONALIZACIONES </span><br>
                        <span class="title"> ADICIONALES GRATIS</span><br>
                        <span class="title"><s>$200</s></span><br>
                        <span class="title"><?= Html::img('@web/images/envio.png', ['class' => 'imagen-carrito-entrega-alta'])?> ENVÍO GRATIS</span><br>

                    </div>
                </div>
                <div class="clear"></div>

                <div class="col-md-12">
                    <div class="form-group center-block" id="btn-siguiente-alta">
                        <?= Html::submitButton('SIGUIENTE', ['class' => 'btn-accion submit-pic', 'id' => 'btn-siguiente-alta'] ) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>








<!--Escritorio-->

<div class="container escritorio-personalizacion">

    <div class="contenedor trazo hidden-sm hidden-xs">
        <div id="texto-personalizacion">
            <div class="text-center franja-crea-escritorio">
               <span class="text-left">
                <img class="diamante-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/diamante.png', true)?>" >
                Diseño Exclusivo</span>
            </div>
        </div>
    </div>
    <div class="bloque-crea-escritorio hidden-sm hidden-xs">
        <div class="bloque-crea row">
            <div class="col-sm-9 col-xs-2 text-center" id="texto-piensa-escritorio">
                <span class="texto-gustaria-escritorio">SÓLO PIENSA QUÉ TE GUSTARÍA</span><br>
                <span class="texto-ilustramos-escritorio">ILUSTRAMOS TU IDEA</span><br>
                <span class="texto-recibe-escritorio">RECIBE 10 - 15 DÍAS</span><br>
                <img class="img-marca-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/marcaRoja.png', true)?>" >
            </div>
       </div>
   </div>
   <div class="bloque2alta-escritorio hidden-sm hidden-xs row">
     <div class="col-sm-6 col-md-6 col-xs-6 ayuda-escritorio">
       <div class="imagen-chica2-escritorio">
            <img class="imagen-chica2-escritorio lazy-load" data-src="<?= Url::to('@web/images/alta_personalizacion/fotobloque2.jpg', true) ?>">
             <div class="col-md-6" >
                  <a href="https://m.me/VocaMXoficial?tr=529281824267405" target="_blank" class="btn-ayuda-alta-escritorio asistencia-messenger text-center">
                    <span class="ayuda-btn">AYUDA EN LÍNEA</span><br>
                  </a>
              </div>
                  <div class="text-center franja-dudas-escritorio">
                    <span class="texto-dudas-escritorio">SI TIENES DUDAS DE CÓMO HACER TU BOMBER</span>
                </div>
        </div>
     </div>
      <div class="col-sm-6 col-md-6 col-xs-6 ayuda-escritorio">
          <div class="bloque-crea-nosotros-escritorio">
                    <span class=" franja-creanosotros-escritorio text-center">CREA CON NOSOTROS</span>
              </div>
              <div class="bloque-ilustracion-escritorio row">
                  <div class="col-sm-6 col-xs-6">
                        <img class="img-creanosotros-escritorio lazy-load" data-src="<?= Url::to('@web/images/alta_personalizacion/creaimagen.jpg', true) ?>" >
                  </div>
                  <div class="col-sm-6 col-xs-6 text-left bloque-ilustracion-texto-escritorio" id="texto-ilustracion-escritorio">
                       <img class="img-logotipovoca-escritorio lazy-load" data-src="<?= Url::to('@web/images/alta_personalizacion/imagotipoVocamx.png', true) ?>" >
                      <label id="texto-ilustra-escritorio">LA ILUSTRACIÓN ES A MEDIDA <br> Y PUEDES HACER UN CAMBIO</label>
                      <label id="texto-guia-escritorio">TE GUIAMOS EN LÍNEA <br> PARA QUE SE VEA MUY COOL</label>
                      <label id="texto-dinos-escritorio">SÓLO DINOS QUE TE GUSTARÍA</label><br>
                      <label id="texto-listo-escritorio">LISTO! <br> RECIBE 10-15 DÍAS</label>
                  </div>
             </div>
          </div>
    </div>
    <div class="bloque-paquete-escritorio hidden-sm hidden-xs row">
        <div class="col-md-7 texto-paquetes">
                <?php $categoria = Categoria::find()->where("categoria.clave = 'ALPR'")->one();?>
                <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                <div class="bloquepaquete-escritorio row">
                    <div class="titulo-paquete-escritorio text-center">
                        <span class="text-center">PAQUETE INTRODUCCIÓN</span>
                    </div>
                    <div class="col-sm-4 col-xs-4 text-center" id="texto-ahorro-escritorio">
                         <label class="precio-alta">
                              <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                  $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                              <?php } else { ?>
                                  $<?= number_format($producto[0]->precios[0]->precio) ?>
                              <?php } ?>
                          </label><br>
                         <label>MEGA AHORRO:</label><br>
                         <label>
                           <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio - $producto[0]->precios[0]->precio_descuento)?>
                            <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio - $producto[0]->precios[0]->precio)?>
                            <?php }?>
                         </label><br>
                    </div>
                    <div class="col-sm-4 col-xs-4 text-left" id="texto-incluye-escritorio">
                         <label class="incluye-alta">INCLUYE:</label><br>
                          <label>CHAMARRA</label><br>
                          <label>DISEÑO EXCLUSIVO</label><br>
                          <label>ESTAMPADO DE ESPALDA</label><br>
                          <label class="texto-asistencia-escritorio">ASISTENCIA EN EL PROCESO</label>
                    </div>
                    <div class="col-sm-4 col-xs-4 text-left" id="texto-personalizado-escritorio" >
                      <label id="texto-gratis-escritorio">GRATIS</label><br>
                          <label id="personalizado-escritorio">PERSONALIZADO</label><br>
                          <label id="frente-escritorio">FRENTE<br>BRAZO<br>HOMBRO <br> ETIQUETA</label><br>
                    </div>
              </div>
              <div class="bloque-granventa-escritorio hidden-sm hidden-xs">
                  <div class="bloquepaquete-escritorio row">
                      <div class="col-sm-2 col-xs-2 text-center ">
                      </div>
                      <div class="col-sm-4 col-xs-4 text-center envios-gratis">
                           <span class="envio-gratis-escritorio">ENVÍO GRATIS</span><br>
                      </div>
                      <div class="col-sm-4 col-xs-4 text-center envio-mexico">
                           <span class="enviomexico">ENVÍO TODO MÉXICO</span><br>
                      </div>
                 </div>
             </div>
          </div>
          <div class="col-md-5 chicapaquete">
<!--               <img class="imagen-introduccion-escritorio lazy-load img-responsive" data-src= "<?= Url::to('@web/images/alta_personalizacion/chicapaquete.png', true) ?>" >-->
          </div>
      </div>
      <div class="bloque3alta row hidden-sm hidden-xs">
          <div class="col-md-6 maximo">
              <div class="bloque-maximo-escritorio ">
                  <div class="bloquemaximo-escritorio">
                      <div class="titulo-maximo-escritorio text-center">
                          <span class="texto-maximo-escritorio">LLEGA AL MÁXIMO NIVEL</span>
                      </div>
                      <div class="col-sm-12 col-xs-12 text-center" style='padding:0;'>
                          <img class="imagen-maximo-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/maximoNivel.jpg', true )?>" >
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-6 elige">
              <div class="bloque-elige-escritorio hidden-sm hidden-xs">
                  <div class="bloqueelige-escritorio">
                      <div class="titulo-elige-escritorio text-center">
                          <span class="texto-elige-escritorio">ELIGE TU COLOR Y TEXTURA</span>
                      </div>
                      <div class="titulo-metalico-escritorio text-center">
                          <span class="texto-metalico-escritorio">METÁLICO</span>
                      </div>
                      <div class="bloque-metalico-escritorio row">
                          <div class="col-sm-3 col-xs-3 text-center metalico-escritorio">
                              <img class="imagen-metalico-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/metalico/mplateado.png', true)?>" >
                              <span class="texto-sudadera-escritorio">PLATA MATE</span>
                          </div>
                          <div class="col-sm-3 col-xs-3 text-center metalico-escritorio">
                                <img class="imagen-metalico-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/metalico/Untitled-1.png', true) ?>" >
                              <span class="texto-sudadera-escritorio">ORO MATE</span>
                          </div>
                          <div class="col-sm-3 col-xs-3 text-center metalico-escritorio">
                                <img class="imagen-metalico-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/metalico/mrojo.png', true) ?>" >
                              <span class="texto-sudadera-escritorio">ROJO NITIDO</span>
                          </div>
                          <div class="col-sm-3 col-xs-3 text-center metalico-escritorio">
                                <img class="imagen-metalico-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/metalico/mpalodeRosa.png', true)?>" >
                              <span class="texto-sudadera-escritorio">ROSA PALO</span>
                          </div>
                      </div>
                  </div>
                  <div class="bloqueelige2-escritorio">
                      <div class="titulo-terciopelo-escritorio text-center">
                          <span class="texto-terciopelo-escritorio">TERCIOPELO</span>
                      </div>
                      <div class="bloque-terciopelo-escritorio row">
                           <div class="col-sm-3 col-xs-3 text-center terciopelo-escritorio">
                                <img class="imagen-terciopelo-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/terciopelo/gris.png', true) ?>" >
                                <span class="texto-sudadera2-escritorio lazy-load">GRIS URBANO</span>
                           </div>
                            <div class="col-sm-3 col-xs-3 text-center terciopelo-escritorio">
                                  <img class="imagen-terciopelo-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/terciopelo/tblancoClasico.png', true)?>" ><span class="texto-sudadera2-escritorio">BLANCO CLÁSICO</span>
                           </div>
                           <div class="col-sm-3 col-xs-3 text-center terciopelo-escritorio">
                                  <img class="imagen-terciopelo-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/terciopelo/Trojo.png', true) ?>" >
                                <span class="texto-sudadera2-escritorio">ROJO PROFUNDO</span>
                           </div>
                           <div class="col-sm-3 col-xs-3 text-center terciopelo-escritorio">
                                  <img class="imagen-terciopelo-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/terciopelo/TnegroNegro.png', true) ?>" >
                                <span class="texto-sudadera2-escritorio">NEGRO EN NEGRO</span>
                           </div>
                       </div>
                   </div>
              </div>
          </div>
      </div>
      <div class="bloque4-alta row">
          <div class="col-md-6 carrusel-exclusivos">
              <div class="container-fluid imagenenes-rk-escritorio hidden-sm hidden-xs">
                  <div class="titulo-exclusivo-escritorio text-center">
                      <span class="texto-diseños-escritorio">DISEÑOS EXCLUSIVOS</span>
                  </div>
                  <div class="imagenenes-rk-escritorio">
                      <div class="carrusel-rk-escritorio" id="carrusel-rk-escritorio" >
                          <div>
                              <img class="imagen-carrousel-rk-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im1.jpg', true)?>" >
                              <div class="texto-fondo-rk-escritorio">
                                  <p class="texto-inspi1-escritorio"><label class="texto-inspirado1-escritorio">LUIS FERNANDO PEÑA</label></p>
                                  <p class="texto-inspi2-escritorio"><label class="texto-inspirado2-escritorio">
                                  DISEÑO INSPIRADO EN LA CDMX Y UN ESTILO MUY CHILANGO UN PUÑO EN LLAMAS CON EL SÍMBOLO  EMBLEMÁTICO DE LA CIUDAD “UN TROMPO DE  PASTOR”</label></p>
                              </div>
                          </div>
                          <div>
                              <img class="imagen-carrousel-rk-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im2.jpg', true)?>" >
                              <div class="texto-fondo-rk-escritorio">
                                  <p class="texto-inspi1-escritorio"><label class="texto-inspirado1-escritorio">SAÚL HERNÁNDEZ</label></p>
                                  <p class="texto-inspi2-escritorio"><label class="texto-inspirado2-escritorio">DISEÑO  INSPIRADO EN SU FRASE “ESTE ES TU RITUAL RAZA” UN ATRAPASUEÑOS DIRIGIDO POR UN JAGUAR UNA EXPRESIÓN TRIBAL DE LA ESENCIA DE SAÚL.
                                  </label></p>
                              </div>
                          </div>
                          <div>
                              <img class="imagen-carrousel-rk-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im3.jpg', true)?>" >
                              <div class="texto-fondo-rk-escritorio">
                                  <p class="texto-inspi1-escritorio"><label class="texto-inspirado1-escritorio">ADAN JODOROWSKY</label></p>
                                  <p class="texto-inspi2-escritorio"><label class="texto-inspirado2-escritorio">DISEÑO  INSPIRADO EN SU ÚLTIMO DISCO “ESENCIA SOLAR” LA MÚSICA COMO PROTAGONISTA GESTANDO SU PROYECTO RODEADO DE LUZ  QUE DA ADAN ORIGEN A LA ARMONÍA Y LA VIDA</label></p>
                              </div>
                          </div>
                          <div>
                              <img class="imagen-carrousel-rk-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im4.jpg', true)?>" >
                              <div class="texto-fondo-rk-escritorio">
                                  <p class="texto-inspi1-escritorio"><label class="texto-inspirado1-escritorio">ROCO PACHUCOTE</label></p>
                                  <p class="texto-inspi2-escritorio"><label class="texto-inspirado2-escritorio">
                                      DISEÑO INSPIRADO EN OMETEOTL DIOS DE LA CREACIÓN DIVINO SEÑOR DE LA DUALIDAD</label></p>
                              </div>
                          </div>
                          <div>
                              <img class="imagen-carrousel-rk-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im5.jpg', true)?>" >
                              <div class="texto-fondo-rk-escritorio">
                                  <p class="texto-inspi1-escritorio"><label class="texto-inspirado1-escritorio">CONFIDENCIAL</label></p>
                                  <p class="texto-inspi2-escritorio"><label class="texto-inspirado2-escritorio">
                                    DISEÑO INSPIRADO EN LA PELÍCULA POESÍA SIN FIN LA MARIPOSA COMO PROTAGONISTA DE LA CREACIÓN Y DEL INFINITO EN UN ESTILO RETRO</label></p>
                              </div>
                          </div>
                          <div>
                              <img class="imagen-carrousel-rk-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im6.jpg', true)?>" >
                              <div class="texto-fondo-rk-escritorio">
                                  <p class="texto-inspi1-escritorio"><label class="texto-inspirado1-escritorio">TITO MOLOTOV</label></p>
                                  <p class="texto-inspi2-escritorio"><label class="texto-inspirado2-escritorio">DISEÑO PURO MEXICAN STYLE INSPIRADO EN EL LETTERING MEXICANO AL ESTILO WILD</label></p>
                              </div>
                          </div>
                          <div>
                              <img class="imagen-carrousel-rk-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im7.jpg', true)?>" >
                              <div class="texto-fondo-rk-escritorio">
                                  <p class="texto-inspi1-escritorio"><label class="texto-inspirado1-escritorio
                                    ">ARMANDO HERNÁNDEZ</label></p>
                                  <p class="texto-inspi2-escritorio"><label class="texto-inspirado2-escritorio">DISEÑO MÉXICO ES CHILUDO,UN JUEGO DE PALABRAS QUE REFIERE A LA PICARDÍA DEL MEXICANO</label></p>
                              </div>
                          </div>
                          <div>
                              <img class="imagen-carrousel-rk-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im8.jpg', true)?>" >
                              <div class="texto-fondo-rk-escritorio">
                                  <p class="texto-inspi1-escritorio"><label class="texto-inspirado1-escritorio">FRANCO ESCAMILLA</label></p>
                                  <p class="texto-inspi2-escritorio"><label class="texto-inspirado2-escritorio">DISEÑO INSPIRADO EN SU ÚLTIMA GIRA "RPM" COMO PROTAGONISTA FRANCO COMO EL DIABLO MAYOR Y LETRAS AL ESTILO WILD</label></p>
                              </div>
                          </div>
                          <div>
                              <img class="imagen-carrousel-rk-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/Carrusel/im9.jpg', true)?>" >
                              <div class="texto-fondo-rk-escritorio">
                                  <p class="texto-inspi1-escritorio"><label class="texto-inspirado1-escritorio">SONIDO LÍQUIDO</label></p>
                                  <p class="texto-inspi2-escritorio"><label class="texto-inspirado2-escritorio">
                                    DISEÑO INSPIRADO EN SU LOGOTIPO VINTAGE DE 1999 UN HOMENAJE PARA FESTEJAR EL 20 ANIVERSARIO DE I CREW </label></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-6 seccion-ayuda">
              <div class="bloque-caritas-escritorio hidden-sm hidden-xs">
                  <div class="bloquecaritas-escritorio">
                      <div class="bloque-importante-escritorio">
                          <span class="franja-importante1-escritorio text-center">IMPORTANTE</span><br>
                          <span class="franja-ayudasiguiente1-escritorio text-center">PARA LOGRAR UN MEJOR RESULTADO,AYÚDANOS CON LO SIGUIENTE</span>
                      <div class="bloqueayuda2-escritorio row">
                          <div class="col-sm-4 col-xs-4">
                              <img class="imagen-clara-alta-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/IdeaClara.png', true) ?>" >
                              <label class="texto-clara-alta-escritorio text-center">TEN CLARA <br> TU IDEA</label>
                          </div>
                          <div class="col-sm-4 col-xs-4">
                              <img class="imagen-ayuda2-alta-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/comunicar.png', true) ?>" >
                              <label class="texto-comunicar-alta-escritorio text-center">PIENSA QUE <br> QUIERES COMUNICAR</label>
                          </div>
                          <div class="col-sm-4 col-xs-4">
                              <img class="imagen-ayuda2-alta-escritorio lazy-load" data-src= "<?= Url::to('@web/images/alta_personalizacion/derechos.png', true) ?>" >
                              <label class="texto-derechos1-alta-escritorio text-center">NO USAR IMÁGENES CON DERECHOS</label>
                          </div>
                       </div>
                   </div>
               </div>
           </div>
            <div class="bloque-conoce-escritorio hidden-sm hidden-xs">
                <div class="bloqueproceso1-escritorio">
                   <span class="franja-conoce1-escritorio text-center">CONOCE NUESTRO PROCESO</span>
                </div>
                <div class="bloque-video1-escritorio text-center">
                      <a href="https://www.youtube.com/watch?v=Enog-fRLlEQ&feature=youtu.be" class="youtube-link hidden"></a>
                      <iframe  id="video-voca" src="https://www.youtube.com/embed/Enog-fRLlEQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="bloque-formulario hidden-sm hidden-xs">
            <div class="text-center franja-comenzar-alta-escritorio">
            <span class="text-left">¿CÓMO COMENZAR?</span>
            </div>
    </div>

    <?php $form = ActiveForm::begin([
      'id' => 'personaliza-form',
      'action' => ['personalizacion', 'photo' => 'true']
        ])
    ?>

    <div class="bloque5-alta row">
        <div class="col-md-6 subirimagen1">
          <div class="bloque-gris-alta-escritorio hidden-sm hidden-xs row">
              <div id="sube-foto-bloque-alta-escritorio">
                  <div class="row">
                      <div id="sube-foto-alta-escritorio" class="col-sm-12 col-md-12">
                          <h3 class="text-red text-left" id="paso1-alta">Paso 1:</h3>
                          <div class="row">
                              <div class="col-md-12 flex-center">
                                  <label for="<?= "fotoCustomDesktop"?>" class="btn-accion label-replace-file" id="sube-foto-btn-alta-escritorio">
                                      <?= Html::img('@web/images/personaliza_foto/subeFoto.png', ['class' => 'flecha-sube']) ?>
                                      Sube tus imágenes
                                  </label>
                                  <?= Html::img('@web/images/personaliza_foto/imagen.png', ['class' => 'imagen-subir-alta-escritorio'])?>
                                  <i class="far fa-check-circle" id="subida-exito"></i>
                              </div>
                          </div>
                          <div id="name-file"></div>
                          <div id="imagen-cargada" style="display:none;">
                              <img src="" />
                          </div>
                          <?= $form->field($photoForm, 'fotoCustom')->fileInput(['id' => "fotoCustomDesktop"])->label(false) ?>
                      </div>
                  </div>
              </div>
              <div id="info-foto-bloque-alta">
                  <div class="row">
                      <div class="col-md-12">
                          <h3 class="text-red text-left" id="paso2-alta-escritorio">Paso 2:</h3>
                              <div class="textos-personaliza-alta-escritorio">
                                  <?= $form->field($photoForm, 'mensaje')->textarea(['placeholder' => 'EXPLÍCANOS BREVEMENTE TU IDEA NUESTRO ILUSTRADOR SE PONDRÁ EN CONTACTO AL DÍA SIGUIENTE', 'rows' => 3 , 'cols' => 5 ])  -> label(false)?>
                                   <?= Html::img('@web/images/personaliza_foto/personaliza.png', ['class' => 'personaliza-img-alta-escritorio'])?>
                              </div>
                              <div class="textos-menu-alta-escritorio">
                                  <?= $form->field($photoForm, 'menu')->checkboxList(['Espalda' => 'Espalda', 'Frente' => 'Frente', 'Hombro' => 'Hombro','Brazo' => 'Brazo','Etiqueta' => 'Etiqueta' ],['id' => 'checkmenu']) -> label(false) ?>
                              </div>
                                <div class="bloque-incluido-escritorio">
                                      <div class="bloqueincluido-escritorio row">
                                         <div class="col-sm-3 col-xs-3 text-center incluido">
                                              <span class="texto-incluido-escritorio">INCLUÍDO</span>
                                         </div>
                                         <div class="col-sm-2 col-xs-2 text-center incluido">
                                              <span class="texto-incluido-escritorio"><s>$50 GRATIS</s></span>
                                         </div>
                                         <div class="col-sm-2 col-xs-2 text-center incluido">
                                              <span class="texto-incluido-escritorio"><s>$50 GRATIS</s></span>
                                         </div>
                                         <div class="col-sm-2 col-xs-2 text-center incluido">
                                              <span class="texto-incluido-escritorio"><s>$50 GRATIS </s></span>
                                         </div>
                                         <div class="col-sm-3 col-xs-3 text-center incluido">
                                              <span class="texto-incluido-escritorio"><s>$50 GRATIS</s></span>
                                         </div>
                                     </div>
                                 </div>
                               <div class="textos-color-escritorio">
                                <span class="color-menu">COLOR</span>
                                  <?= $form->field($photoForm, 'color')->dropdownList(['PLATA(METÁLICO)' => 'PLATA(METÁLICO)', 'ORO(METÁLICO)' => 'ORO(METÁLICO)', 'ROJO(METÁLICO)' => 'ROJO(METÁLICO)','ROSA(METÁLICO)' => 'ROSA(METÁLICO)','GRIS(TERCIOPELO)' => 'GRIS(TERCIOPELO)','BLANCO(TERCIOPELO)' => 'BLANCO(TERCIOPELO)', 'ROJO(TERCIOPELO)' => 'ROJO(TERCIOPELO)', 'NEGRO(TERCIOPELO)' => 'NEGRO(TERCIOPELO)'],['placeholder' => 'PERSONALIZA: FECHA,NOMBRE,@INSTAGRAM O FRASE',]) -> label(false)?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
        </div>
          <div class="col-md-6 subirimagen2">
         <div class="bloque-gris2-alta-escritorio row hidden-sm hidden-xs">
            <div class="col-md-5" >
                <a href="https://m.me/VocaMXoficial?tr=529281824267405" target="_blank" class="btn-ayuda-altapersonalizacion-escritorio asistencia-messenger">
                <?= Html::img('@web/images/ayuda.png') ?>&emsp;<span>Ayuda</span><br>
            </a>
            </div>
             <div class="text-center franja-ayuda-altapersonalizacion-escritorio">
                <h3 class="text-center" id="texto-asistencia-alta-escritorio">¿QUIERES ASISTENCIA EN TU PEDIDO?</h3>
            </div>
            <div id="elementos-precio-alta-escritorio">
                <div id="producto-nuevo-alta-escritorio">
                     <H3 class="producto-nuevotitulo-alta-escritorio">PRODUCTOS</H3>
                      <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img-alta'])?> CHAMARRA NEGRA</label><br>
                     <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita'])?> ILUSTRACION A LA MEDIDA</label><br>
                     <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img-alta'])?> CON UN CAMBIO</label><br>
                     <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img-alta'])?> PERSONALIZACIÓN:</label><br>
                     <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita'])?> COLOR PERSONALIZADO</label><br>
                </div>

                <div id="numero-elementos-alta-escritorio">
                    <?= $form->field($photoForm, 'elementos')->input('number', ['min' => 1, 'max' => 5, 'value' => 1, 'autocomplete' => 'off'])  ?>
                    <input type="hidden" id="precio_base" value="1690" />
                    <input type="hidden" id="precio_base_tachado" value="2115" />
                </div>
                <div id="precio-trazado-alta-escritorio">
                    <?= $form->field($photoForm, 'precio')->hiddenInput()  ?>
                    <?php $categoria = Categoria::find()->where("categoria.clave = 'ALPR'")->one();?>
                    <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                    <span id="texto-precio-alta-escritorio">
                        <span id="numero-precio-alta-escritorio">
                              <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                  $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                              <?php } else { ?>
                                  $<?= number_format($producto[0]->precios[0]->precio) ?>
                              <?php } ?>
                        </span>
                    </span>
                        <span class="title-ahorro" > MEGA AHORRO: </span>
                    <div class="ahorro-bomber-alta-escritorio">
                        <span class="number">
                              <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                  $<?= number_format($producto[0]->precios[0]->precio - $producto[0]->precios[0]->precio_descuento)?>
                              <?php } else { ?>
                                  $<?= number_format($producto[0]->precios[0]->precio - $producto[0]->precios[0]->precio)?>
                              <?php }?>
                        </span>
                    </div>
                    <div class="dia-entrega-alta-escritorio text-center">
                        <span class="title">PERSONALIZACIONES </span><br>
                        <span class="title"> ADICIONALES GRATIS</span><br>
                        <span class="title "><s>$200</s></span><br>
                        <span class="title"><?= Html::img('@web/images/envio.png', ['class' => 'imagen-carrito-entrega-alta-escritorio'])?> ENVÍO GRATIS</span><br>

                    </div>
                </div>
                <div class="clear"></div>

                <div class="col-md-12">
                    <div class="form-group center-block" id="btn-siguiente-alta-escritorio">
                        <?= Html::submitButton('SIGUIENTE', ['class' => 'btn-accion submit-pic', 'id' => 'btn-siguiente-alta-escritorio'] ) ?>
                    </div>
                </div>
            </div>
        </div>
      </div>
      </div>
    <?php ActiveForm::end(); ?>
</div>
