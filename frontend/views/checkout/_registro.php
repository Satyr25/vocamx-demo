<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
 ?>
<?php $form = ActiveForm::begin([
    'id' => 'formulario-direccion',
    'scrollToErrorOffset' => 210,
    'encodeErrorSummary' => false
]); ?>
    <div class="container-fluid">
        <div class="row hidden-sm hidden-xs">
            <div class="col-md-12">
                Contacto
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($registro, 'nombre', [
                    'template' => "<div>\n{error}\n<div class=\"input-group\"><div class=\"input-group-addon\"><i class=\"fas fa-user\"></i></div>\n{input}\n</div></div>"
                    ]
                )
                ->textInput(['autofocus' => true, 'placeholder' => 'Nombre *'])
                ->label(false) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($registro, 'apellido', [
                    'template' => "<div>\n{error}\n<div class=\"input-group\"><div class=\"input-group-addon\"><i class=\"fas fa-user\"></i></div>\n{input}\n</div></div>"
                    ]
                )
                ->textInput(['placeholder' => 'Apellido *'])
                ->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($registro, 'telefono', [
                    'template' => "<div>\n{error}\n<div class=\"input-group\"><div class=\"input-group-addon\"><i class=\"fas fa-phone\"></i></div>\n{input}\n</div></div>"
                    ]
                )
                ->textInput(['placeholder' => 'Teléfono *', 'autocomplete' => 'tel'])
                ->label(false) ?>
            </div>
        </div>
        <div class="row hidden-sm hidden-xs">
            <div class="col-md-12">
                ¿Donde quieres recibir tu compra?
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($registro, 'direccion',[
                    'template' => "<div>\n{error}\n<div class=\"input-group\"><div class=\"input-group-addon\"><i class=\"fas fa-map-marker-alt\"></i></div>\n{input}\n</div></div>"
                    ]
                )
                ->textInput(['placeholder' => 'Dirección *', 'autocomplete' => 'given-name'])
                ->label(false) ?>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <?= $form->field($registro, 'externo',['template'=>"<div>\n{error}\n{input}\n</div>"])
                ->textInput(['placeholder' => 'No. ext.*'])
                ->label(false) ?>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <?= $form->field($registro, 'interno')
                ->textInput(['placeholder' => 'No. int. (opcional)'])
                ->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($registro, 'entre_calles')
                ->textInput(['placeholder' => 'Entre calles (opcional)'])
                ->label(false) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($registro, 'referencias')
                ->textInput(['placeholder' => 'Referencias (opcional)'])
                ->label(false) ?>
            </div>
        </div>
        <div class="row">
             <div class="col-md-6">
                <?php
                    $ip = Yii::$app->geoip->ip();
                    if($ip->country == 'Mexico'){
                        $registro->pais = 42;
                    } else{
                        $registro->pais = 55;
                    }
                 ?>

                <?= $form->field($registro, 'pais',['template'=>"<div>\n{error}\n{input}\n</div>"])
                    ->widget(Select2::classname(), [
                     'data' => $paises,
                     'language' => 'es',
                     'options' => ['placeholder' => 'País*', 'id' => 'pais-id'],
                     'pluginOptions' => [
                         'allowClear' => false
                        ],
                    ])->label(false) ?>

            </div>
            <div class="col-md-6">
                <?= $form->field($registro, 'cp',['template'=>"<div>\n{error}\n{input}\n</div>"])
                    ->textInput(['placeholder' => 'Código postal *', 'maxlength' => '5'])
                    ->label(false) ?>
            </div>
        </div>
        <div class="row" style='display:none'>
            <div class="col-md-12">
                <?= $form->field($registro, 'continente')->widget(DepDrop::classname(), [
                        'type' => DepDrop::TYPE_SELECT2,
                        'options' => [
                            'id' => 'continente-id',
//                            'style' => 'display:none !important'
                        ],
                        'pluginOptions' => [
                            'depends' => ['pais-id'],
                            'initialize' => true,
                            'url' => Url::to(['/clientes/continente'])
                        ]
                    ])->label(false);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <div id="loader-zip" class="lds-ring oculto"><div></div><div></div><div></div><div></div></div>
            </div>
        </div>
        <div id="campos-auto">
            <div class="row">
                <div class="col-md-6">

                     <?= $form->field($registro, 'estado')->widget(DepDrop::classname(), [
                        'type' => DepDrop::TYPE_SELECT2,
                        'options' => ['id' => 'estado-id'],
                        'pluginOptions' => [
                            'depends' => ['pais-id'],
                            'initialize' => true,
                            'placeholder' => 'Estado',
                            'url' => Url::to(['/clientes/estado'])
                        ]
                    ])->label(false);
                    ?>

                </div>
                <div class="col-md-6">
                    <?= $form->field($registro, 'ciudad',['template'=>"<div>\n{error}\n{input}\n</div>"])
                        ->textInput(['placeholder' => 'Ciudad *', 'disabled' => 'disabled'])
                        ->label(false) ?>
                </div>
            </div>
            <div class="row row-eeuu-form">
                <div class="col-md-6">
                    <?= $form->field($registro, 'municipio',['template'=>"<div>\n{error}\n{input}\n</div>"])
                        ->textInput(['placeholder' => 'Municipio/Alcaldía *', 'disabled' => 'disabled'])
                        ->label(false) ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="RegistroForm[colonia]" id="registroform-colonia" class="form-control" placeholder="Colonia*">
                            <option value="" disabled selected>Colonia*</option>
                        </select>
                        <?= $form->field($registro, 'colonia_manual')
                        ->textInput(['placeholder' => 'Colonia *', 'disabled' => 'disabled'])
                        ->label(false) ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 centrado">
                    <?= Html::submitButton('Calcular Envío', ['class' => 'btn btn-accion', 'id' => 'registro-chk-btn']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
<?php ActiveForm::end(); ?>
