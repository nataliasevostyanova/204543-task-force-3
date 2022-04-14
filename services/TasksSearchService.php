<?php

namespace app\services;

use app\models\forms\TasksSearchForm;
use app\models\Task;
use app\models\Category;
use TaskForce\TaskStatus;
use yii\data\ActiveDataProvider;
use Carbon\Carbon;

/**
 * Класс для формирования запроса с учетом данных, полученных из формы поиска заданий
 */
class TasksSearchService
{
    public $dataProvider;

    public function tasksSearch(TasksSearchForm $modelForm)
    {
        $tasks = Task::find()
            ->with('category', 'town')
            ->where(['task_status' => TaskStatus::STATUS_NEW])
            ->orderBy('created_date DESC');

        if ($modelForm->categories_id) {

            $tasks->andWhere(['category_id' => $modelForm->categories_id]);
        }

        if ($modelForm->noDoer) {
            $tasks->andWhere(['doer_id' => null]);
        }

        if ($modelForm->period > 0) {
           // $carbon = (new Carbon)->now()->sub($modelForm->period->format('Y-m-d H:i:s'));
            //$tasks->andWhere(['>', 'created_date', $carbon]);
            switch ($modelForm->period) {
                case ('1 час'):
                    $tasks->andFilterWhere(['>', 'task.created_date', (new Carbon)->now()->subHour()->format('Y-m-d H:i:s')]);
                    break;
                case ('12 часов'):
                    $tasks->andFilterWhere(['>', 'task.created_date', (new Carbon)->now()->subHours(12)->format('Y-m-d H:i:s')]);
                    break;
                case ('24 часа'):
                    $tasks->andFilterWhere(['>', 'task.created_date', (new Carbon)->now()->subHours(24)->format('Y-m-d H:i:s')]);
            }
        }
        return $dataProvider = new ActiveDataProvider([
            'query' => $tasks,
            'pagination' => [
                'pageSize' => 3,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_date' => SORT_DESC
                ]
            ],
        ]);
    }
}