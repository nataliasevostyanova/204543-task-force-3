<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;
use app\models\Category;
use app\models\forms\TasksSearchForm;

$this->title = 'TaskForce: Новые задания';
?>
    <div class="left-column">
        <h3 class="head-main head-task">Новые задания</h3>

       <!-- here ListView widget must be -->
       <?php  echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_new-tasks',
                'pager' => [
                    'prevPageLabel' => '',
                    'nextPageLabel' => '',
                    'pageCssClass' => 'pagination-item',
                    'prevPageCssClass' => 'pagination-item mark',
                    'nextPageCssClass' => 'pagination-item mark',
                    'activePageCssClass' => 'pagination-item--active',
                    'options' => ['class' => 'pagination-list'],
                    'linkOptions' => ['class' => 'link link--page'],
                    'options' => [
                        'class' => 'pagination-list',
                    ],
           ],
          ]); ?>

<!-- блок пагинации start
        <div class="pagination-wrapper">
            <ul class="pagination-list">
                <li class="pagination-item mark">
                    <a href="#" class="link link--page"></a>
                </li>
                <li class="pagination-item">
                    <a href="#" class="link link--page">1</a>
                </li>
                <li class="pagination-item pagination-item--active">
                    <a href="#" class="link link--page">2</a>
                </li>
                <li class="pagination-item">
                    <a href="#" class="link link--page">3</a>
                </li>
                <li class="pagination-item mark">
                    <a href="#" class="link link--page"></a>
                </li>
            </ul>
        </div>
         блок пагинации end -->
    </div>

    <!-- блок выбора задач start -->
    <div class="right-column">
       <div class="right-card black">
          <div class="search-form">
              <?php $form = ActiveForm::begin([
                  'id' => 'search-task',
                  'action' => '/tasks',
                  'method' => 'get',
                  'options' => [
                      'tag' => false,
                  ]
              ]); ?>
                <h4 class="head-card">Категории</h4>
                <div class="form-group">

                    <?= $form->field($modelForm, 'categories_id')->checkboxList($modelForm->getCategoriesList(),
                        [
                        'separator' => '<br>',
                        'item' => function ($index, $label, $name, $checked, $value) use ($modelForm) {
                            settype($modelForm->categories_id, 'array');
                            $checked = in_array($value, $modelForm->categories_id) ? ' checked' : '';
                            return
                                 "<input type=\"checkbox\" name=\"$name\" id=\"$value\" value=\"$value\"$checked>
                                  <label class=\"control-label\" for=\"$value\">$label</label>";
                        }
                        ])
                   ?>
                </div>

                <h4 class="head-card">Дополнительно</h4>
                <div class="form-group">
                    <?=Html::activeCheckbox($modelForm, 'noDoer',  [ 'checked' => false, 'class' => 'form-group', 'label' => false])?>
                    <?=Html::activeLabel($modelForm, 'noDoer')?>
                </div>

                <!-- Выбрать интеревал -->
                <h4 class="head-card">Период</h4>
                <div class="form-group">
                   <?= Html::activeDropDownList($modelForm, 'period', $modelForm->getPeriod(),
                        [ 'id' => 'period-value']) ?>
                </div>

                <?=Html::button(Html::encode('Искать'), [ 'class' => 'button button--blue', 'type' => 'submit'])?>

            <?php $form = ActiveForm::end(); ?>
          </div>
       </div>
    </div>
    <!-- блок выбора задач end -->
