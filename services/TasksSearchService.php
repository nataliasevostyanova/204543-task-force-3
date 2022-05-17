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

        if ($modelForm->period>0) {
          $tasks->andWhere(['>', 'created_date', (new Carbon)->now()->subHours($modelForm->period)]);
        }

        return $dataProvider = new ActiveDataProvider([
            'query' => $tasks,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_date' => SORT_DESC
                ]
            ],
        ]);
    }
}
