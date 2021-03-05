<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;
use app\models\Categoria;

class ProductoSearch extends Producto
{
    public $precio;
    public $sexo;
    public $precio_descuento;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'categoria', 'status'], 'integer'],
            [['precio','precio_descuento'], 'double'],
            [['nombre', 'sexo'], 'string'],
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
    public function search($params)
    {
        $query = Producto::find()
            ->select([
                'producto.id AS id',
                'producto.status AS status', 
                'producto.nombre AS nombre',
                'sexo.sexo AS sexo', 
                'categoria.nombre AS categoria',
                'precio.precio AS precio',
                'precio.precio_descuento AS precio_descuento',
                'precio.precio_usd AS precio_usd',
                'precio.precio_descuento_usd AS precio_descuento_usd'
            ])
            ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
            ->join('INNER JOIN', 'sexo', 'sexo.id = producto.sexo_id')
            ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
            ->where(['!=', 'categoria.clave', 'DECO']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if(!$this->status){
            $query->andFilterWhere(['=', 'producto.status', '1' ]);
        }

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->orderBy('producto.created_at DESC');

        return $dataProvider;
    }
    
    public function searchDeco($params)
    {
        $query = Producto::find()
            ->select([
                'producto.id AS id',
                'producto.status AS status', 
                'producto.nombre AS nombre',
                'sexo.sexo AS sexo', 
                'categoria.nombre AS categoria',
                'precio.precio AS precio',
                'precio.precio_descuento AS precio_descuento',
                'precio.precio_usd AS precio_usd',
                'precio.precio_descuento_usd AS precio_descuento_usd'
            ])
            ->join('INNER JOIN', 'precio', 'precio.producto_id = producto.id')
            ->join('INNER JOIN', 'sexo', 'sexo.id = producto.sexo_id')
            ->join('INNER JOIN', 'categoria', 'categoria.id = producto.categoria_id')
            ->where(['=', 'categoria.clave', 'DECO']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if(!$this->status){
            $query->andFilterWhere(['=', 'producto.status', '1' ]);
        }

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->orderBy('producto.created_at DESC');

        return $dataProvider;
    }

    public function searchOrder()
    {
        $coleccionables = Categoria::find()->where(['clave' => '2018'])->one();
        $query = Producto::find()
            ->where(['categoria_id' => $coleccionables->id])
            ->andFilterWhere(['=', 'producto.status', '1']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'orden' => SORT_ASC
                ]
            ],
            'pagination' => false
        ]);

        return $dataProvider;
    }
    public function searchOrderDeco()
    {
        $coleccionables = Categoria::find()->where(['clave' => 'DECO'])->one();
        $query = Producto::find()
            ->where(['categoria_id' => $coleccionables->id])
            ->andFilterWhere(['=', 'producto.status', '1']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'orden' => SORT_ASC
                ]
            ],
            'pagination' => false
        ]);

        return $dataProvider;
    }
}
