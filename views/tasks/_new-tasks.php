<?php

use yii\helpers\Html;
use Carbon\Carbon;
use yii\data\ActiveDataProvider;

?>

        <div class="task-card">
            <div class="header-task">
                <a  href="#" class="link link--block link--big"><?= Html::encode($newtasks->title); ?></a>
                <p class="price price--task"><?= Html::encode($newtasks->budget); ?></p>
            </div>
            <p class="info-text"><span class="current-time"><?= Carbon::parse($newtasks->created_date)->locale('ru')
                        ->diffForHumans(); ?></span></p>
            <p class="task-text"><?= Html::encode($newtasks->description); ?>
            </p>
            <div class="footer-task">
                <p class="info-text town-text"><?= Html::encode($newtasks->town->city); ?></p>
                <p class="info-text category-text"><?= Html::encode($newtasks->category->name); ?></p>
                <a href="#" class="button button--black">Смотреть Задание</a>
            </div>
        </div>

