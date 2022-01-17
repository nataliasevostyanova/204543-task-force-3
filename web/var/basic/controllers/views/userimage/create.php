<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserImage */

$this->title = Yii::t('app', 'Create User Image');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
