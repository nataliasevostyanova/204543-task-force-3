<?php

namespace app\controllers;

use Yii;



use yii\web\Controller;
use app\models\forms\TasksSearchForm;
use app\services\TasksSearchService;
use yii\data\ActiveDataProvider;


class TasksController extends Controller
{
    public function actionIndex()
    {
        $modelForm = new TasksSearchForm();

        if(Yii::$app->request->get()) {

            $modelForm->load(Yii::$app->request->get());
        }

        $taskSearch = new TasksSearchService();
        $tasks = $taskSearch->taskSearch();

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