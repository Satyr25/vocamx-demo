<?php

namespace frontend\models\forms;

use Yii;
use yii\base\Model;
use DrewM\MailChimp\MailChimp;
use app\models\ListaMails;

/**
 * ContactForm is the model behind the contact form.
 */
class NewsletterForm extends Model
{
    public $email;
    public $error;
    private $transaction;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
        ];
    }

    public function saveMail()
    {
        $mailchimp = new MailChimp(Yii::$app->params['mailchimp_key']);
        $list_id = Yii::$app->params['mailchimp_list_id'];

        $result = $mailchimp->post("/lists/$list_id/members/", [
        	'email_address' => $this->email,
            'status'        => 'subscribed',
        ]);

        if ($mailchimp->success()) {
            $entradaMail = new ListaMails();
            $entradaMail->correo = $this->email;
            if (!$entradaMail->save()) {
                $this->error = "Error guardando correo en la base de datos.";
                return false;
            }
        	return true;
        } else {
            $this->error = $result["title"];
        	return false;
        }
    }
    
}
