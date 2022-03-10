<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;


$this->title = 'TaskForce: Новые задания';
?>
    <div class="left-column">
        <h3 class="head-main head-task">Новые задания</h3>

        <!-- here ListView widget must be -->
       <?php  echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_new-tasks',
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
                  'method' => 'get',
                  'options' => [
                      'tag' => false,
                      //'class' => 'search-form',
                  ]
              ]); ?>
                <h4 class="head-card">Категории</h4>
                    <div class="form-group">
                        <?= Html::activeCheckboxList($modelForm, 'categories', $modelForm->getCategoriesList(), [
                            'tag' => false,
                            'unselect' => '',
                            'item' => function ($index, $label, $name, $checked, $value) {
                                $checked = $checked ? : '';
                                return
                                "<input type='checkbox' id=$index value=$value checked='$checked'>                                
                                 <label class='control-label' for='$index'>$label</label>";

                        }])?>
                    </div>

<!-- чекбоксы с категориями html start
                        <div>
                            <input type="checkbox" id="сourier-services" checked>
                            <label class="control-label" for="сourier-services">Курьерские услуги</label>
                            <input id="cargo-transportation" type="checkbox">
                            <label class="control-label" for="cargo-transportation">Грузоперевозки</label>
                            <input id="translations" type="checkbox">
                            <label class="control-label" for="translations">Переводы</label>
                        </div>
чекбоксы с категориями html end -->
                <h4 class="head-card">Дополнительно</h4>
                <div class="form-group">

                    <?=Html::activeCheckbox($modelForm, 'noResponse', ['class' => 'form-group', 'label' => false])?>
                    <?=Html::activeLabel($modelForm, 'noResponds')?>


                <!-- <input id="without-performer" type="checkbox" checked>
                    <label class="control-label" for="without-performer">Без исполнителя</label>
                    -->
                </div>

                <!-- Выбрать интеревал -->
                <h4 class="head-card">Период</h4>
                <div class="form-group">
                    <?=Html::activeLabel($modelForm, 'period') ?>
                    <?=Html::activeDropDownList($modelForm, 'period', $modelForm->getPeriod(),
                [ 'value' => $get['period']??'', 'encode' => true,]) ?>

                    <!--
                        <label for="period-value"></label>
                        <select id="period-value">
                            <option>1 час</option>
                            <option>12 часов</option>
                            <option>24 часа</option>
                        </select>
                       -->
                </div>
                <?=Html::button(Html::encode('Искать'), ['class' => 'button--blue', 'type' => 'submit'])?>
           <!--  <input type="button" class="button button--blue" value="Искать"> -->
            <?php $form = ActiveForm::end(); ?>
          </div>
       </div>
    </div>
    <!-- блок выбора задач end -->
