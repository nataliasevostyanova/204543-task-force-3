<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserStatistic */

$this->title = Yii::t('app', 'Update User Statistic: {name}', [
    'name' => $model->user_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Statistics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-statistic-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>