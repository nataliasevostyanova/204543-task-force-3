<?php

namespace app\services;

use app\models\forms\TasksSearchForm;
use app\models\Task;
use TaskForce\TaskStatus;
use Carbon\Carbon;

/**
 * Класс для формирования запроса с учетом данных, полученных из формы поиска заданий
 */
class TasksSearchService
{
    public function taskSearch()
    {
        $tasks = Task::find()
            ->with('category', 'town')
            ->where(['task_status' => TaskStatus::STATUS_NEW]);

        $modelForm = new TasksSearchForm();

        if($modelForm->categories) {
            $tasks->andWhere(['category_id' => $modelForm->categories->id]);
        }

        if($modelForm->getPeriod()) {

            switch ($modelForm->getPeriod()) {
                case ('1 час'):
                    return $tasks->andFilterWhere([ '<=', Carbon::diffInHours($tasks->created_date), 1]);

                case ('12 часов'):
                    return $tasks->andFilterWhere([ '<=', Carbon::diffInHours($tasks->created_date), 12]);

                case ('24 часа'):
                    return $tasks->andFilterWhere([ '<=', Carbon::diffInHours($tasks->created_date), 24]);
            }
        }

        $tasks->orderBy(['created_date' => 'SORT_DESC']);

        return $tasks;
    }
}