<?php
namespace frontend\models;

use yii\base\Model;
use app\models\Review;

class ReviewForm extends Model
{
    public $producto_id;
    public $nombre;
    public $email;
    public $puntuacion;
    public $review;
    private $transaction;

    public function rules()
    {
        return [
            [['nombre', 'email', 'puntuacion'], 'trim'],
            [['nombre', 'email','producto_id','puntuacion','review'], 'required'],
            [['email'], 'email'],
            [['nombre', 'review'], 'string'],
            [['producto_id'], 'integer'],
            [['puntuacion'], 'integer', 'max' => 5, 'min' => 0]
        ];
    }

    public function attributeLabels(){
        return[
            'puntuacion' => 'Puntuación'
        ];
    }

    public function guardarReview(){
        $connection = \Yii::$app->db;
        $this->transaction = $connection->beginTransaction();

        $review = new Review();
        $review->nombre = $this->nombre;
        $review->email = $this->email;
        $review->puntuacion = $this->puntuacion;
        $review->review = $this->review;
        $review->producto_id = $this->producto_id;
        $review->status = 0;
        if(!$review->save()){
            $this->transaction->rollback();
            Yii::$app->session->setFlash('error', "Hubo un error al recibir su review.");
            return false;
        }
        $this->transaction->commit();
        return true;
    }
}
