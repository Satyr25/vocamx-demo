<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedido;
use app\models\EstadoPedido;

class PedidoSearch extends Pedido
{
    public $fecha;
    public $cliente;
    public $estado;
    public $proveedor_envio;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado'], 'integer'],
            [['fecha', 'cliente'], 'string'],
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
        $query = Pedido::find()
            ->select([
                'pedido.numero_pedido AS numero_pedido', 'pedido.id AS id', 'pedido.created_at AS fecha', 'pedido.costo_envios AS costo_envios', 'pedido.costo_total AS total',
                'cliente.nombre AS cliente', 'cliente.telefono AS telefono',
                'estado_pedido.nombre AS estado'
            ])
            ->join('LEFT JOIN', 'cliente', 'cliente.id = pedido.cliente_id')
            ->join('LEFT JOIN', 'estado_pedido', 'estado_pedido.id = pedido.estado_pedido_id')
            ->join('LEFT JOIN', 'envia_ya', 'envia_ya.pedido_id = pedido.id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if(!$this->estado){
            $confirmado = EstadoPedido::find()->where('clave="CONF"')->one();
            $this->estado = $confirmado->id;
        }
        $query->andFilterWhere(['=', 'pedido.estado_pedido_id', $this->estado]);
        $query->andFilterWhere(['like', 'cliente.nombre', $this->cliente]);

        $query->orderBy('pedido.created_at DESC');

        return $dataProvider;
    }
}
