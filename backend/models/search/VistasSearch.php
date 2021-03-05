<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;

class VistasSearch extends Producto
{
    public $fecha_inicio;
    public $fecha_final;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_inicio', 'fecha_final'], 'safe'],
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
            ->select(['producto.*', 'SUM(pageview.tiempo_visita) AS tiempo_visita', 'count(pageview.producto_id) AS numero_vistas'])
            ->where(['status' => 1])
            ->join('INNER JOIN', 'pageview', 'pageview.producto_id = producto.id')
            ->orderBy(['numero_vistas' => SORT_DESC])
            ->groupBy('producto.id')
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
            return $dataProvider;
        }

        $timestamp_inicio = strtotime($this->fecha_inicio);
        $timestamp_final = strtotime($this->fecha_final);

        $query->andWhere(['between', 'pageview.created_at', $timestamp_inicio, $timestamp_final]);
//        $raw = $query->createCommand()->getRawSql();
//        var_dump($raw); exit;
        return $dataProvider;
    }
}
