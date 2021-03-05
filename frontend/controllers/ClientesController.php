<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use app\models\Producto;
use frontend\models\SignupForm;
use app\models\TipoUsuario;
use common\models\User;
use frontend\models\DireccionForm;
use frontend\models\RegistroForm;
use common\models\LoginForm;
use app\models\Pais;
use app\models\Estado;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;

class ClientesController extends Controller
{
    public function actionIndex(){
        if(!Yii::$app->user->isGuest)
            return $this->goHome();
        return $this->render('index');
    }

    public function actionRegistro(){
        $registro = new RegistroForm();
        if($registro->load(Yii::$app->request->post()) && $registro->crear()){
            \Yii::$app->Carrito->switchUsuario();
            return $this->redirect(['checkout/']);
        }
        $paises = ArrayHelper::map(Pais::find()->all(), 'id', 'nombre');
        return $this->render('registro',[
            'registro' => $registro,
            'paises' => $paises
        ]);
    }

    public function actionDireccion(){
        $direccion = new DireccionForm();
        if($direccion->load(Yii::$app->request->post()) && $direccion->crear()){
            return $this->redirect(['checkout/']);
        }else{
            return $this->render('direccion', [
                'direccion' => $direccion,
            ]);
        }
    }

    public function actionLogin(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if($model->login()){
                \Yii::$app->Carrito->switchUsuario();
                if(Yii::$app->request->isAjax){
                    return true;
                } else {
                    return $this->redirect(['checkout/']);
                }
            }
            if (Yii::$app->request->isAjax) {
                return false;
            } else {
                Yii::$app->session->setFlash('error', "Usuario o contraseña invalidos.");
                return $this->redirect(['clientes/login']);
            }
        } else {
            if (Yii::$app->request->isAjax) {
                return false;
            } else {
                $model->password = '';
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionEstado(){
        $datos = Yii::$app->request->post("depdrop_all_params");
        if(!$datos){
            return Json::encode(['output'=>'', 'selected'=>'']);
        }
        $estados = Estado::find()->where('pais_id='.$datos['pais-id'])->all();
        $respuesta = [];
        foreach($estados as $estado){
            $respuesta[] = [
                'id' => $estado->id,
                'name' => $estado->estadonombre
            ];
        }
        return Json::encode(['output'=>$respuesta, 'selected'=>'']);
    }

    public function actionContinente(){
        $datos = Yii::$app->request->post("depdrop_all_params");
        if(!$datos){
            return Json::encode(['output'=>'', 'selected'=>'']);
        }
        $pais = Pais::find()->where('id ='.$datos['pais-id'])->one();
        $respuesta = [['id' => $pais->continente_id, 'name'=>$pais->continente_id]];
        return Json::encode(['output'=>$respuesta, 'selected'=>$respuesta]);
    }

    public function actionRecuperarPassword(){
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Hemos enviado un correo a '.$model->email.' con los pasos para recuperar tu contraseña.');
                Yii::$app->mailer->compose()
                    ->setTo($model->email)
                    ->setFrom([Yii::$app->params['email'] => "VocaMX"])
                    ->setSubject("Recuperar contraseña")
                    ->setHtmlBody(
                        $this->renderPartial('_recuperarPassword',[
                            'token' => $model->token
                        ])
                        )->send();
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Ocurrió un error al enviar correo a '.$model->email.'.');
            }
        }

        return $this->render('recuperar_password',[
            'model' => $model,
        ]);
    }

    public function actionNuevoPassword($token)
    {
        $model = new ResetPasswordForm();

        if(!$model->validar($token)){
            Yii::$app->session->setFlash('error', 'Token de recuperación de password Invalido.');
            return $this->goHome();
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'El nuevo password se guardó correctamente.');

            return $this->goHome();
        }

        return $this->render('nuevo_password', [
            'model' => $model,
        ]);
    }

}
