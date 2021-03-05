<?php

namespace app\models;

use Yii;
use app\models\ColorDecoracion;

/**
 * This is the model class for table "variante_decoracion".
 *
 * @property int $id
 * @property int $color_decoracion_id
 * @property int $medidas_id
 * @property int $producto_id
 * @property double $precio
 * @property double $precio_usd
 *
 * @property ColorDecoracion $colorDecoracion
 * @property Medidas $medidas
 * @property Producto $producto
 */
class VarianteDecoracion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variante_decoracion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color_decoracion_id', 'medidas_id', 'producto_id', 'precio', 'precio_usd'], 'required'],
            [['color_decoracion_id', 'medidas_id', 'producto_id'], 'integer'],
            [['precio', 'precio_usd'], 'number'],
            [['color_decoracion_id'], 'exist', 'skipOnError' => true, 'targetClass' => ColorDecoracion::className(), 'targetAttribute' => ['color_decoracion_id' => 'id']],
            [['medidas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medidas::className(), 'targetAttribute' => ['medidas_id' => 'id']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['producto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color_decoracion_id' => 'Color Decoracion ID',
            'medidas_id' => 'Medidas ID',
            'producto_id' => 'Producto ID',
            'precio' => 'Precio',
            'precio_usd' => 'Precio Usd',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColorDecoracion()
    {
        return $this->hasOne(ColorDecoracion::className(), ['id' => 'color_decoracion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedidas()
    {
        return $this->hasOne(Medidas::className(), ['id' => 'medidas_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'producto_id']);
    }

    public function colores($producto_id){
        $colores = ColorDecoracion::find()
            ->join('INNER JOIN', 'variante_decoracion', 'variante_decoracion.color_decoracion_id = color_decoracion.id')
            ->where('variante_decoracion.producto_id = '.$producto_id)
            ->all();
        return $colores;
    }

    public function medidas($producto_id, $color){
        $ip = Yii::$app->geoip->ip();
        if( $ip->country !== 'Mexico'){
            $campos = ['medidas.*', 'variante_decoracion.precio_usd AS precio'];
        }else{
            $campos = ['medidas.*', 'variante_decoracion.precio AS precio'];
        }
        $medidas = Medidas::find()
            ->select($campos)
            ->join('INNER JOIN', 'variante_decoracion', 'variante_decoracion.medidas_id = medidas.id')
            ->where('variante_decoracion.producto_id = '.$producto_id.' AND variante_decoracion.color_decoracion_id = '.$color)
            ->all();
        return $medidas;
    }
}
