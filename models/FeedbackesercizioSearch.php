<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Feedbackesercizio;

/**
 * FeedbackesercizioSearch represents the model behind the search form of `app\models\Feedbackesercizio`.
 */
class FeedbackesercizioSearch extends Feedbackesercizio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_feedback', 'evaluation', 'esercizio_id'], 'integer'],
            [['descr', 'result', 'file', 'file_type'], 'safe'],
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
        $query = Feedbackesercizio::find();

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
            'id_feedback' => $this->id_feedback,
            'evaluation' => $this->evaluation,
            'esercizio_id' => $this->esercizio_id,
        ]);

        $query->andFilterWhere(['like', 'descr', $this->descr])
            ->andFilterWhere(['like', 'result', $this->result])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'file_type', $this->file_type]);

        return $dataProvider;
    }
}
