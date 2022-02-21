<?php

namespace app\services;

use app\models\forms\TasksSearchForm;
use app\models\Task;
use TaskForce\TaSkStatus;

class TaskSearchService
{
    public function taskSearch()
    {
        $tasks = Tasks::find()->where(['status' => TaskStatus::STATUS_NEW]);
        $modelForm = new TasksSearchForm();

        if (!empty($modelForm->categories)) {
            $tasks->Join('categories', 'categories.id = tasks.category_id')
                ->andWhere([
                    'category_id' => $modelForm->category_ids
                ]);
        }

        if ($modelForm->noResponses) {
            $tasks->leftJoin('responses', 'responses.task_id = tasks.id')
                ->andWhere('responses.task_id IS NULL');
        }

        if ($modelForm->remote) {
            $tasks->andWhere('location IS NULL');
        }

        $tasks->andWhere(['status' => Task::STATUS_NEW]);

        if ($modelForm->search) {
            $tasks->andWhere(['like', 'tasks.name', $modelForm->search]);
        }

        if ($modelForm->interval) {

            switch ($modelForm->interval) {
                case 1:
                    $tasks->andFilterWhere(['>=', 'tasks.dt_add', date('Y-m-d')]);
                    break;
                case 2:
                    $tasks->andFilterWhere(['>=', 'tasks.dt_add', date('Y-m-d', strtotime('-1 week'))]);
                    break;
                case 3:
                    $tasks->andFilterWhere(['>=', 'tasks.dt_add', date('Y-m-d', strtotime('-1 month'))]);
            }
        }

        $tasks->orderBy('dt_add DESC');

        return $tasks;
    }
}