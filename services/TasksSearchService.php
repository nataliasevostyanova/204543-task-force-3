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
    public function tasksSearch(TasksSearchForm $modelForm) : ActiveDataProvider
    {
        $tasks = Task::find()
            ->with('category', 'town')
            ->where(['task_status' => TaskStatus::STATUS_NEW])
            ->orderBy(['created_date' => 'SORT_DESC'])
            ->all();

        if($modelForm->categories) {
            $tasks->andWhere(['category_id' => $modelForm->categories]);
        }

        if($modelForm->getPeriod()) {

            switch ($modelForm->getPeriod()) {
                case (TasksSearchForm::PERIOD_1):
                    return $tasks->andFilterWhere([ '<=', (new Carbon)->diffInHours($tasks->created_date), 1]);

                case (TasksSearchForm::PERIOD_12):
                    return $tasks->andFilterWhere([ '<=', (new Carbon)->diffInHours($tasks->created_date), 12]);

                case (TasksSearchForm::PERIOD_24):
                    return $tasks->andFilterWhere([ '<=', (new Carbon)->diffInHours($tasks->created_date), 24]);
               }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $tasks,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'dt_add' => SORT_DESC
                ]
            ],
        ]);

        return $dataProvider;
    }
}