<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\EmpresaForm;
use frontend\models\ContactoForm;
use app\models\ContenidoContacto;

class ContactoController extends Controller
{
    public function actionIndex(){
        $searchModel = new contenidoContacto();        
        $contenido = $searchModel->search(Yii::$app->request->queryParams);
        $contacto = new ContactoForm();
        if ($contacto->load(Yii::$app->request->post()) && $contacto->validate()) {
            if ($contacto->enviar(Yii::$app->params['email_admin'])) {
                Yii::$app->session->setFlash('success', '¡Gracias por contactarnos!.');
            } else {
                Yii::$app->session->setFlash('error', 'Ocurrió un error al enviar formulario de contacto.');
            }

            return $this->refresh();
        }
        return $this->render('index',[
            'contacto' => $contacto,
            'contenido' => $contenido
        ]);
    }

    public function actionEmpresa(){
        $empresa = new EmpresaForm();
        if ($empresa->load(Yii::$app->request->post()) && $empresa->validate()) {
            if ($empresa->enviar(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', '¡Gracias por contactarnos!.');
            } else {
                Yii::$app->session->setFlash('error', 'Ocurrió un error al enviar formulario de contacto.');
            }

            return $this->refresh();
        }
        return $this->render('empresa',[
            'empresa' => $empresa
        ]);
    }

    public function actionPrensa(){
        return $this->render('prensa');
    }
}
