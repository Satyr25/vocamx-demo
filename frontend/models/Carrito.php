<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "carrito".
 *
 * @property int $id
 * @property int $user_id
 * @property string $cookie_id
 * @property double $total
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 * @property ProductoCarrito[] $productoCarritos
 */
class Carrito extends \yii\db\ActiveRecord
{
    public $cantidad;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['total'], 'number'],
            [['cookie_id'], 'string', 'max' => 45],
            //[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors(){
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'cookie_id' => 'Cookie ID',
            'total' => 'Total',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoCarritos()
    {
        return $this->hasMany(ProductoCarrito::className(), ['carrito_id' => 'id']);
    }

    public function idCarrito($cookie, $identificador){
        if($cookie){
            $carrito = Carrito::find()->where('cookie_id="'.$identificador.'"')->one();
        }else{
            $carrito = Carrito::find()->where('user_id="'.$identificador.'"')->one();
        }
        if($carrito){
            return $carrito->id;
        }
        if($cookie){
            $this->cookie_id = $identificador;
        }else{
            $this->user_id = $identificador;
        }
        if(!$this->save())
            return false;
        return $this->id;

    }
}
