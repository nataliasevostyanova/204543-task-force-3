<?php

use yii\helpers\Html;
use Carbon\Carbon;
use app\services\TasksSearchService;

?>

        <div class="task-card">
            <div class="header-task">
                <a  href="#" class="link link--block link--big"><?= Html::encode($tasks->title); ?></a>
                <p class="price price--task"><?= Html::encode($tasks->budget); ?></p>
            </div>
            <p class="info-text"><span class="current-time"><?= Carbon::parse($tasks->created_date)->locale('ru')
                        ->diffForHumans(); ?></span></p>
            <p class="task-text"><?= Html::encode($tasks->description); ?>
            </p>
            <div class="footer-task">
                <p class="info-text town-text"><?= Html::encode($tasks->town->city); ?></p>
                <p class="info-text category-text"><?= Html::encode($tasks->category->name); ?></p>
                <a href="#" class="button button--black">Смотреть Задание</a>
            </div>
        </div>

