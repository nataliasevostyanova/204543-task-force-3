<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserStatisticSeach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-statistic-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'views_number') ?>

    <?= $form->field($model, 'available_now') ?>

    <?= $form->field($model, 'last_visit') ?>

    <?= $form->field($model, 'rating') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
