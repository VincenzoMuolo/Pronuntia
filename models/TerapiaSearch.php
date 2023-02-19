<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Terapia;

/**
 * TerapiaSearch represents the model behind the search form of `app\models\Terapia`.
 */
class TerapiaSearch extends Terapia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_terapia', 'logopedista_id', 'paziente_id'], 'integer'],
            [['name_terapia', 'descr'], 'safe'],
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
        $query = Terapia::find();

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
            'id_terapia' => $this->id_terapia,
            'logopedista_id' => $this->logopedista_id,
            'paziente_id' => $this->paziente_id,
        ]);

        $query->andFilterWhere(['like', 'name_terapia', $this->name_terapia])
            ->andFilterWhere(['like', 'descr', $this->descr]);

        return $dataProvider;
    }
}
