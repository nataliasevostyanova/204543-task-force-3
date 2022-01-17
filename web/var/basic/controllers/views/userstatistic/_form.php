<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserStatistic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-statistic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'views_number')->textInput() ?>

    <?= $form->field($model, 'available_now')->textInput() ?>

    <?= $form->field($model, 'last_visit')->textInput() ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
