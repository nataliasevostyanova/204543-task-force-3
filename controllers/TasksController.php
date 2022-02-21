<?php

namespace app\controllers;

use app\models\Category;
use yii\base\Controller;
//use app\models\Task;
use Yii;
//use TaskForce\TaskStatus;
use app\models\forms\TasksSearchForm;
use app\models\services\TasksSearchService;
use yii\data\ActiveDataProvider;
use Carbon\Carbon;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $modelForm = new TasksSearchForm();

        if(Yii::$app->request->get()) {

            $modelForm->load(Yii::$app->request->get());
        }

        $taskSearch = new TasksSearchService();
        $tasks = $taskSearch->searchTask($modelForm);

        $dataProvider = new ActiveDataProvider([
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

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'modelForm' => $modelForm,
        ]);
    }


    }



}