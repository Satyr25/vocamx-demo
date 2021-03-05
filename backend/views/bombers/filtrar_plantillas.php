<?php 
use yii\bootstrap\ActiveForm;

 ?>

 <div class="container">
    <?php $form = ActiveForm::begin(); ?>
    <?php foreach($plantillas as $plantilla): ?>
        <p><?= $plantilla->nombre ?></p>
        <?= $form->field($filtroForm, 'filtros['.$plantilla->id.']') -> checkboxList($filtros);  ?>
    <?php endforeach; ?>
    <button>Guardar</button>
    <?php ActiveForm::end(); ?>
 </div>