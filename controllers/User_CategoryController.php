<?php

namespace app\controllers;

use app\models\User_Category;
use app\models\User_CategorySeach;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * User_CategoryController implements the CRUD actions for User_Category model.
 */
class User_CategoryController extends Controller
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
     * Lists all User_Category models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new User_CategorySeach();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User_Category model.
     * @param int $user_id id пользователя
     * @param int $category_id id категории
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id, $category_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $category_id),
        ]);
    }

    /**
     * Creates a new User_Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User_Category();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'user_id' => $model->user_id, 'category_id' => $model->category_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User_Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $user_id id пользователя
     * @param int $category_id id категории
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id, $category_id)
    {
        $model = $this->findModel($user_id, $category_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'category_id' => $model->category_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User_Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $user_id id пользователя
     * @param int $category_id id категории
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id, $category_id)
    {
        $this->findModel($user_id, $category_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User_Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $user_id id пользователя
     * @param int $category_id id категории
     * @return User_Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $category_id)
    {
        if (($model = User_Category::findOne(['user_id' => $user_id, 'category_id' => $category_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
