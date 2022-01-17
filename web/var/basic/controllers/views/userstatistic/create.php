<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserStatistic */

$this->title = Yii::t('app', 'Create User Statistic');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Statistics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-statistic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
