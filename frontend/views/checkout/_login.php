<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div id="bloque-login-sitio">
    <?php $form = ActiveForm::begin(['id' => 'formulario-login']); ?>
    <?= $form->field($loginForm, 'email')->textInput(['autofocus' => true, 'placeholder' => 'E-mail'])->label(false) ?>
    <?= $form->field($loginForm, 'password')->passwordInput(['placeholder' => 'Contraseña'])->label(false) ?>
    <?php ActiveForm::end(); ?>
    <button id="login-chk-btn" class="btn btn-accion">Enviar</button>
</div>