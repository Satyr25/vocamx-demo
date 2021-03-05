<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use app\models\ColorDecoracion;
use yii\helpers\Url;

/**
 * ContactForm is the model behind the contact form.
 */
class ColorForm extends Model
{
     public $color;
     public $precio;
     public $precio_usd;
     public $id;

    /*
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color'], 'required'],
            [['id'], 'integer'],
            [['color'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    public function guardar(){
        $nuevo_color = new ColorDecoracion();
        $nuevo_color->color = $this->color;
        if(!$nuevo_color->save()){
            return false;
        }
        return true;
    }

    public function actualizar(){
        $color = ColorDecoracion::findOne($this->id);
        $color->color = $this->color;
        if(!$color->save()){
            return false;
        }
        return true;
    }
}
