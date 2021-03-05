<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use app\models\Review;

/**
 * ContactForm is the model behind the contact form.
 */
class ReviewForm extends Model
{
    public $id;
    public $nombre;
    public $email;
    public $puntuacion;
    public $review;
    public $status;
    private $transaction;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'email', 'puntuacion'], 'trim'],
            [['nombre', 'email', 'producto_id'], 'required'],
            [['email'], 'email'],
            [['nombre', 'review'], 'string'],
            [['producto_id', 'status'], 'integer'],
            [['puntuacion'], 'integer', 'max' => 5, 'min' => 0]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'email' => 'Email',
            'puntuacion' => 'Puntuacion',
            'review' => 'Review',
            'status' => 'Status',
        ];
    }

    public function actualizar($id)
    {
        $connection = \Yii::$app->db;
        $this->transaction = $connection->beginTransaction();

        $review = Review::findOne($id);
        $this->id = $review->id;
        $review->nombre = $this->nombre;
        $review->email = $this->email;
        $review->puntuacion = $this->puntuacion;
        $review->status = $this->status;
        $review->review = $this->review;
        if (!$review->update()) {
            $this->transaction->rollback();
            var_dump($review->getErrors());exit;
            return false;
        }

        $this->transaction->commit();
        return true;
    }

    public function cargarDatos($id)
    {
        $review = Review::findOne($id);

        $this->id = $id;
        $this->nombre = $review->nombre;
        $this->email = $review->email;
        $this->puntuacion = $review->puntuacion;
        $this->review = $review->review;
        $this->status = $review->status;
    }
}
