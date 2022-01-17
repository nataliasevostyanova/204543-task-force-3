<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User_Category */

$this->title = Yii::t('app', 'Create User Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user--category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
