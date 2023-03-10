<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Appuntamento;

/**
 * AppuntamentoSearch represents the model behind the search form of `app\models\Appuntamento`.
 */
class AppuntamentoSearch extends Appuntamento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_date', 'logopedista_id'], 'integer'],
            [['date', 'state'], 'safe'],
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
        $query = Appuntamento::find();

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
            'id_date' => $this->id_date,
            'date' => $this->date,
            'logopedista_id' => $this->logopedista_id,
        ]);

        $query->andFilterWhere(['like', 'state', $this->state]);

        return $dataProvider;
    }
}
