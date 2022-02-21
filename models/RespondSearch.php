<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Respond;

/**
 * RespondSearch represents the model behind the search form of `app\models\Respond`.
 */
class RespondSearch extends Respond
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'doer_id', 'execute_budget'], 'integer'],
            [['comment', 'created_at'], 'safe'],
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
        $query = Respond::find();

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
            'id' => $this->id,
            'task_id' => $this->task_id,
            'doer_id' => $this->doer_id,
            'execute_budget' => $this->execute_budget,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
