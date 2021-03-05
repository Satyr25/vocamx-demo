<?php
namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;
use app\models\ProductoPedido;


class ExcelSearch extends Producto
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
    public function search($params){
//        var_dump($this->fecha_final);
//        var_dump($this->fecha_inicio);exit;
        $noUsuarios = array();
//        $excel = array();
        $productos = Producto::find()
            ->select([
                'producto.nombre',
                'producto.id',
                'SUM(pageview.tiempo_visita) AS tiempo_visita',
                'floor(SUM(pageview.tiempo_visita)/((unix_timestamp() - producto.created_at) / 86400)) AS promedio',
                'sexo.sexo AS sexo',
                'count(pageview.producto_id) AS numero_vistas',                
            ])
            ->where([
                'producto.status' => 1, 
            ])
            ->andWhere(['between', 'pageview.created_at', $this->fecha_inicio, $this->fecha_final])
            ->join('INNER JOIN', 'pageview', 'pageview.producto_id = producto.id' )
            ->join('INNER JOIN', 'sexo', 'sexo.id = producto.sexo_id')
            ->orderBy(['numero_vistas' => SORT_DESC])
            ->groupBy('producto.id')
            ->asArray()
            ->all();
        
        for ($i=0; $i<count($productos); $i++){  
            $noUsuarios[$i] = [''];
            $usuarios = ProductoPedido::find()
                ->Select([
                    'count(user.id) AS usuarios',
                ])
                ->where([
                    'producto_pedido.producto_id' => $productos[$i]['id'],
                    'user.tipo_usuario_id' => 2,
                ])
                ->andWhere(['between', 'pageview.created_at', $this->fecha_inicio, $this->fecha_final])
                ->join('INNER JOIN', 'pedido', 'pedido.id = producto_pedido.pedido_id')
                ->join('INNER JOIN', 'cliente', 'cliente.id = pedido.cliente_id')
                ->join('INNER JOIN', 'user', 'user.id = cliente.user_id')
                ->join('INNER JOIN', 'pageview', 'producto_pedido.producto_id = pageview.producto_id')
                ->asArray()
                ->one();
            $productos[$i]['usuarios'] = $usuarios['usuarios'];
            $productos[$i]['noUsuarios'] = $noUsuarios['noUsuarios'];
        }
        
        for ($i=0; $i<count($productos); $i++){         
            $check = ProductoPedido::find()
                ->Select([
                    'count(pedido.estado_pedido_id) AS checkouts',
                ])
                ->where([
                    'producto_pedido.producto_id' => $productos[$i]['id'],
                    'pedido.estado_pedido_id' => 1, 
                ])
                ->andWhere(['between', 'pedido.created_at', $this->fecha_inicio, $this->fecha_final])
                ->join('INNER JOIN', 'pedido', 'pedido.id = producto_pedido.pedido_id')
                ->asArray()
                ->one();
            $productos[$i]['checkouts'] = $check['checkouts'];
            unset($productos[$i]['id']);
        }
        for ($i=0; $i<count($productos); $i++){
            $productos[$i]['tiempo_visita'] = $this->convertirSegundos($productos[$i]['tiempo_visita']);
            $productos[$i]['promedio'] = $this->convertirSegundos($productos[$i]['promedio']);
        } 
        return $productos;
    }
    
    private function convertirSegundos($segundos){
//        if ($segundos == '0'){
//            $hora_texto = '0s';
//        }else{
//            $horas = floor($segundos / 3600);
            $minutos = floor($segundos / 60);
//            $segundos = $segundos - ($horas * 3600) - ($minutos * 60);
            $hora_texto = "";
//            if ($horas > 0 ) {
//                $hora_texto .= $horas . "h ";
//            }
//            if ($minutos > 0 ) {
                $hora_texto = $minutos;
//            }
//            if ($segundos > 0 ) {
//                $hora_texto .= $segundos . "s";
//            }  
//        }
        return $hora_texto;
    }
}
