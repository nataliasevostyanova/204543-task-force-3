<?php

use yii\helpers\Html;
use Carbon\Carbon;
?>

     <!-- <?php foreach($tasks as $task): ?> -->
            <div class="task-card">
                <div class="header-task">
                    <a  href="#" class="link link--block link--big"><?= Html::encode($task->title); ?></a>
                    <p class="price price--task"><?= Html::encode($task->budget); ?></p>
                </div>
                <p class="info-text"><span class="current-time"><?= Carbon::parse($task->created_date)->locale('ru')
                            ->diffForHumans(); ?></span></p>
                <p class="task-text"><?= Html::encode($task->description); ?>
                </p>
                <div class="footer-task">
                    <p class="info-text town-text"><?= Html::encode($task->town->city); ?></p>
                    <p class="info-text category-text"><?= Html::encode($task->category->name); ?></p>
                    <a href="#" class="button button--black">Смотреть Задание</a>
                </div>
            </div>
    <!--<?php endforeach; ?> -->
