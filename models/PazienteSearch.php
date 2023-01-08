<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Paziente;

/**
 * PazienteSearch represents the model behind the search form of `app\models\Paziente`.
 */
class PazienteSearch extends Paziente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_paziente', 'age', 'caregiver_id'], 'integer'],
            [['name', 'surname', 'sex'], 'safe'],
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
        $query = Paziente::find();

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
            'id_paziente' => $this->id_paziente,
            'age' => $this->age,
            'caregiver_id' => $this->caregiver_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'sex', $this->sex]);

        return $dataProvider;
    }
}
