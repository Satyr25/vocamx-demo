<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SoldCorreo;

class SoldCorreoSearch extends SoldCorreo
{
    public $talla;
    public $producto;
    public $email;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['talla'], 'integer'],
            [['producto', 'email'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params){
        $query = SoldCorreo::find()
            ->select([
                'sold_correo.*',
                'producto.nombre AS producto',
                'talla.talla AS talla',
            ])
            ->join('INNER JOIN', 'producto', 'producto.id = sold_correo.producto_id')
            ->join('INNER JOIN', 'talla', 'talla.id = sold_correo.talla_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere (['=', "talla.id", $this->talla]);
            $query->andFilterWhere (['like', "producto.nombre", $this->producto]);
            return $dataProvider;
        }
        return $dataProvider;
    }
}
