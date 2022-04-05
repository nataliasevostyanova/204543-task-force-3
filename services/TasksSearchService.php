<?php

namespace app\services;

use app\models\forms\TasksSearchForm;
use app\models\Task;
use TaskForce\TaskStatus;
use yii\data\ActiveDataProvider;
use Carbon\Carbon;

/**
 * Класс для формирования запроса с учетом данных, полученных из формы поиска заданий
 */
class TasksSearchService
{
    public function tasksSearch(TasksSearchForm $modelForm)
    {
        $tasks = Task::find()
            ->with('category', 'town');
            //->where(['task_status' => TaskStatus::STATUS_NEW]);

        if($modelForm->categories) {
            $tasks->andWhere(['category_id' => $modelForm->categories]);
            //$tasks->andWhere(['in', 'category_id', $modelForm->categories]);
        }

        if($modelForm->noDoer) {
            $tasks->andWhere(['task_status' => TaskStatus::STATUS_NEW]);
        }

        if($modelForm->getPeriod()) {

            switch ($modelForm->getPeriod()) {
                case (TasksSearchForm::PERIOD_DEFAULT):
                    return $tasks;
                case (TasksSearchForm::PERIOD_1):
                    return $tasks->andFilterWhere([ '<=', (new Carbon)->diffInHours($tasks->created_date), 1]);
                case (TasksSearchForm::PERIOD_12):
                    return $tasks->andFilterWhere([ '<=', (new Carbon)->diffInHours($tasks->created_date), 12]);
                case (TasksSearchForm::PERIOD_24):
                    return $tasks->andFilterWhere([ '<=', (new Carbon)->diffInHours($tasks->created_date), 24]);
            }
        }
        return  new ActiveDataProvider([
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