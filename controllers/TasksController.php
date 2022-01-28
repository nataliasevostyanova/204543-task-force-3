<?php

namespace app\controllers;

use yii\base\Controller;
use app\models\Task;
use Carbon\Carbon;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $tasks = Task::find()
            ->with([ 'town', 'category'])
            ->where(['task_status' => 'новое'])
            ->andWhere(['>', 'finish_date', Carbon::now('+3:00')->toDateTimeString()])
            ->orderBy(['created_date' => SORT_DESC])
            ->all();

        return $this->render('index', ['tasks' => $tasks]);
    }

}