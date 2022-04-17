<?php

use yii\helpers\Html;
use Carbon\Carbon;

?>
        <div class="task-card">
            <div class="header-task">
                <a  href="#" class="link link--block link--big"><?= Html::encode($model->title); ?></a>
                <p class="price price--task"><?= Html::encode($model->budget); ?> &#8381</p>
            </div>
            <p class="info-text"><span class="current-time"><?= Carbon::parse($model->created_date)->locale('ru')
                        ->diffForHumans() ?></span><span> 'created_date:'. <?= $model->created_date?></span></p>
            <p class="task-text"><?= Html::encode($model->description); ?>
            </p>
            <div class="footer-task">
                <p class="info-text town-text"><?= Html::encode($model->town->city); ?></p>
                <p class="info-text category-text"><?= Html::encode($model->category->name); ?></p>
                <a href="#" class="button button--black">Смотреть Задание</a>
            </div>
        </div>

