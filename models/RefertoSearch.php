<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Referto;

/**
 * RefertoSearch represents the model behind the search form of `app\models\Referto`.
 */
class RefertoSearch extends Referto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_referto', 'diagnosi_id'], 'integer'],
            [['descr'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Referto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_referto' => $this->id_referto,
            'diagnosi_id' => $this->diagnosi_id,
        ]);

        $query->andFilterWhere(['like', 'descr', $this->descr]);

        return $dataProvider;
    }
}
