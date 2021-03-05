<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductoPedido;

class VentasGeneroSearch extends ProductoPedido
{
    public $genero;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['genero'], 'safe'],
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
        $query = ProductoPedido::find()
            ->select(["producto_pedido.cantidad AS cantidad", "producto.nombre AS nombre_producto" , "tipo.nombre AS nombre_tipo", "tipo.clave AS clave_tipo"])
            ->join("INNER JOIN", "producto", "producto.id = producto_pedido.producto_id")
            ->join("INNER JOIN", "producto_tipo", "producto_tipo.producto_id = producto.id")
            ->join("INNER JOIN", "tipo", "tipo.id = producto_tipo.tipo_id")
            ->join('INNER JOIN', 'pedido', 'pedido.id = producto_pedido.pedido_id')
            ->join('INNER JOIN', 'estado_pedido', 'estado_pedido.id = pedido.estado_pedido_id')
            ->where(['or', 'estado_pedido.clave = "CONF"', 'estado_pedido.clave = "ENV"'])
            ->orderBy(['cantidad' => SORT_DESC])
            ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            $query->andWhere (["or", "tipo.clave = 'HOM'", "tipo.clave = 'MUJ'"]);
            return $dataProvider;
        }
        $query->andFilterWhere(['=', 'tipo.clave', $this->genero]);
        return $dataProvider;
    }
}
