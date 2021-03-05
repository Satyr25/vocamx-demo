<?php

namespace app\models;

use Yii;

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
    public $color;
    public $medidas;
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

    public function variantesProducto($producto_id){
        $variantes =
            $this->find()
            ->select([
                'variante_decoracion.id', 'precio', 'precio_usd',
                'medidas_id', 'color_decoracion_id',
                'color_decoracion.color AS color', 'medidas.medidas AS medidas'])
            ->join('INNER JOIN', 'color_decoracion', 'color_decoracion.id = variante_decoracion.color_decoracion_id')
            ->join('INNER JOIN', 'medidas', 'medidas.id = variante_decoracion.medidas_id')
            ->where('producto_id = '.$producto_id)
            ->all();
        return $variantes;
    }
}
