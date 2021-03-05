<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;
use app\models\TipoUsuario;

class UserSearch extends Model
{
    public $correo;
    public $id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['correo'], 'string']
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
        $tipo = TipoUsuario::find()->where('clave="ADMN"')->one();
        $query = User::find()
            ->select([
                'user.id', 'user.email'
            ])
            ->where('tipo_usuario_id='.$tipo->id);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);

        $this->load($params);
        return $dataProvider;
    }
}
