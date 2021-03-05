<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use app\models\Pedido;
use app\models\PagoTienda;
use app\models\Cliente;

require_once '../../Openpay/Vocamx.php';

/**
 * Signup form
 */
class TiendaForm extends Model
{
    public $numero_pedido;
    public $cliente_id;
    public $mensaje_error;

    private $transaction;

    public function rules()
    {
        return [
            [['numero_pedido'],'required'],
            [['numero_pedido'], 'string'],
        ];
    }

    public function generar(){
        $connection = \Yii::$app->db;
        $this->transaction = $connection->beginTransaction();

        $openpay = new \Vocamx();
        $openpay->conectar();

        $pedido = Pedido::find()->where('numero_pedido="'.$this->numero_pedido.'"')->one();
        if(\Yii::$app->user->isGuest){
            $cliente = Cliente::findOne($this->cliente_id);
            $customerData = array(
                'name' => $cliente->nombre,
                'email' => $cliente->email,
                'requires_account' => false
            );
        } else {
            $usuario = $usuario = User::findOne(\Yii::$app->user->identity->id);
            $cliente = Cliente::find()->where('user_id='.\Yii::$app->user->identity->id)->one();
            $customerData = array(
                'name' => $cliente->nombre,
                'email' => $usuario->email,
                'requires_account' => false
            );
        }

        $cargo = array(
            'method' => 'store',
            'amount' => $pedido->costo_total,
            'description' => 'Compra de Bomber Vocamx',
            'order_id' => $this->numero_pedido,
            'customer' => $customerData
        );

        if(!$cargo = $openpay->cargo($cargo)){
            $this->mensaje_error = $openpay->mensaje_error;
            return false;
        }

        $pago = new PagoTienda();
        $pago->pedido_id = $pedido->id;
        $pago->id_openpay = $cargo->id;
        $pago->referencia = $cargo->payment_method->reference;
        $pago->barcode_url = $cargo->payment_method->barcode_url;
        $pago->recibo = $openpay->url_recibo.'/'.$pago->referencia;
        $pago->total = $pedido->costo_total;
        $pago->save();

        $this->transaction->commit();
        return true;
    }

}
