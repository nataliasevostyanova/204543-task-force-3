<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Task;

/**
 * TaskSearch represents the model behind the search form of `app\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'doer_id', 'town_id', 'category_id', 'budget'], 'integer'],
            [['created_date', 'title', 'description', 'finish_date', 'task_status'], 'safe'],
            [['latitude', 'longitude'], 'number'],
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
        $query = Task::find();

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
            'created_date' => $this->created_date,
            'client_id' => $this->client_id,
            'doer_id' => $this->doer_id,
            'town_id' => $this->town_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'category_id' => $this->category_id,
            'budget' => $this->budget,
            'finish_date' => $this->finish_date,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'task_status', $this->task_status]);

        return $dataProvider;
    }
}
