<?php

namespace app\controllers;

use app\models\UserStatistic;
use app\models\UserStatisticSeach;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserStatisticController implements the CRUD actions for UserStatistic model.
 */
class UserStatisticController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all UserStatistic models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserStatisticSeach();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserStatistic model.
     * @param int $user_id id  исполнителя
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id),
        ]);
    }

    /**
     * Creates a new UserStatistic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UserStatistic();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'user_id' => $model->user_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserStatistic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $user_id id  исполнителя
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id)
    {
        $model = $this->findModel($user_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserStatistic model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $user_id id  исполнителя
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id)
    {
        $this->findModel($user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserStatistic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $user_id id  исполнителя
     * @return UserStatistic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id)
    {
        if (($model = UserStatistic::findOne(['user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
