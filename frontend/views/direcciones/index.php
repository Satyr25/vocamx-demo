<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div id="bloque-header"></div>
<div id="direcciones-guardadas">
    <div class="container">
        <h2>Mis direcciones</h2>
        <?php foreach($direcciones as $i => $direccion){ ?>
            <div class="direccion">
                <div class="opcion-direccion">
                    <input type="radio" id="direccion-<?= $direccion->id ?>" name="direccion-guardada" value="<?= $direccion->id ?>" />
                </div>
                <div class="datos-direccion">
                    <label for="direccion-<?= $direccion->id ?>">
                        C.P. <?= $direccion->cp ?><br>
                        <?= $direccion->calle.' '.$direccion->num_ext.($direccion->num_int ? ' / '.$direccion->num_int : '') ?><br>
                        <?= $direccion->colonia ?><br>
                        <?php if($direccion->pais){ ?>
                            <?= $direccion->ciudad ?>, <?= $direccion->estado ?>. <?= $direccion->pais ?>
                        <?php } ?>
                    </label>
                    <a href="<?= Url::to(['direcciones/editar','id' => $direccion->id]) ?>" class="editar-direccion">
                        Editar
                    </a>
                </div>
            </div>
            <input type="hidden" value="<?= Url::to(['checkout/index/','direccion_id' => $direccion->id]) ?>" id="redireccion-<?= $direccion->id ?>"/>
        <?php } ?>
        <a href="<?= Url::to(['direcciones/agregar']) ?>" class="btn-accion" id="nueva-direccion">
            Agregar otra dirección
        </a>
    </div>
</div>
