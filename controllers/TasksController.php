<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\forms\TasksSearchForm;
use app\services\TasksSearchService;



class TasksController extends Controller
{


    public function actionIndex() : string
    {
        $dataProvider = new ActiveDataProvider();
        $modelForm = new TasksSearchForm();

        if(Yii::$app->request->get()) {

            $modelForm->load(Yii::$app->request->get());
            $tasksSearch = new TasksSearchService();
            $dataProvider = $tasksSearch->tasksSearch($modelForm);
        }
        $newtasks = $dataProvider->getModels(); //при таком определении $newtasks yii даёт ошибку
                                                // The "query" property must be an instance of a class
                                                // that implements the QueryInterface
        // Проблема: не знаю, как правильно передать в view/tasks/_new-tasks.php $newtasks из $dataProvider :((

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'modelForm' => $modelForm,
            'newtasks' => $newtasks,
            ]);
    }

}