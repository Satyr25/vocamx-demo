<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

use common\models\User;
use app\models\TipoUsuario;



/**
 * ContactForm is the model behind the contact form.
 */
class UsuarioForm extends Model
{
    public $email;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['password'], 'string'],
            [['email'], 'email']

        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    public function guardar(){
        $tipo = TipoUsuario::find()->where('clave="ADMN"')->one();
        $user = new User();
        $user->username = time();
        $user->email = $this->email;
        $user->tipo_usuario_id = $tipo->id;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if(!$user->save()){
            return false;
        }
        return true;
    }

    public function cargarDatos($id){
        $usuario = User::findOne($id);
        $this->email = $usuario->email;
    }

    public function actualizar($id){
        $user = User::findOne($id);
        if(!$user){
            return false;
        }
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if(!$user->save()){
            $transaction->rollback();
            return false;
        }
        return true;
    }

}
