<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\User_CategorySeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user--category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'category_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User_Category $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'user_id' => $model->user_id, 'category_id' => $model->category_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>