<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\Exception;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

use api\modules\v1\models\Pedido;
use api\modules\v1\models\EstadoPedido;
use api\modules\v1\models\EnviaYa;
use api\modules\v1\models\User;
use api\modules\v1\models\Cliente;

class NotificacionController extends ActiveController
{
    public $modelClass = '';


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => ['recepcion'],
            'authMethods' => [
                // HttpBasicAuth::className(),
                // HttpBearerAuth::className(),
                // QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    public function actionRecepcion(){
    $datos_pago = file_get_contents("php://input");
	$pago = json_decode($datos_pago);
	if($pago->type == 'charge.succeeded' && $pago->transaction->method == 'store'){
        $pedido = Pedido::find()->where('numero_pedido="'.$pago->transaction->order_id.'"')->one();
        if($pedido){
            $estado = EstadoPedido::find()->where('clave="CONF"')->one();
            $pedido->estado_pedido_id = $estado->id;
            $pedido->save();

            $envio = EnviaYa::find()->where('pedido_id='.$pedido->id)->one();
            $productos = $pedido->productos($pedido->id);
            $cliente = new Cliente();
            $cliente = $cliente->datos($pedido->cliente_id);
            $usuario = User::findOne($cliente->user_id);
            Yii::$app->mailer->compose()
                ->setTo($usuario->email)
                ->setFrom([Yii::$app->params['email'] => "VocaMX"])
                ->setSubject("Confirmación de compra")
                ->setHtmlBody(
                    $this->renderPartial('_correo_confirmacion',[
                        'envio' => $envio,
                        'cliente' => $cliente,
                        'productos' => $productos
                    ])
                    )
                ->send();
            Yii::$app->mailer->compose()
                ->setTo(Yii::$app->params['email'])
                ->setFrom([Yii::$app->params['email'] => "VocaMX"])
                ->setSubject("Nuevo Pedido")
                ->setHtmlBody(
                    $this->renderPartial('_correo_pedido',[
                        'envio' => $envio,
                        'cliente' => $cliente,
                        'productos' => $productos
                    ])
                    )
                ->send();
        }
	}
	//file_put_contents('test.txt',$pago->type);
    }


}
