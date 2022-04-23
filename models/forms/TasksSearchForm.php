<?php

namespace app\models\forms;

use yii\base\Model;
use app\models\Category;
use yii\helpers\ArrayHelper;

/**
 * Класс для создания формы поиска/фильтрации заданий по категориям, новизне, времени создания
 */

class TasksSearchForm extends Model
{
    public $categories_id;
    public $categories;
    public $noDoer;
    public $period;
    public $search;

    const PERIODS_VALUES = [
                0 =>'Не выбран',
                1 => '1 час',
               12 => '12 часов',
               24 => '24 часа',
         ];

    public function rules()
    {
        return [
            [['categories_id', 'categories','noDoer', 'period', 'search'], 'safe']
        ];
    }

    /**
     * метод для получения списка категорий для формы поиска заданий по категориям
     * @return array
     */
    public function getCategoriesList() : array
    {
         $this->categories = Category::find()
             ->select(['name'])
             ->indexBy('id')
             ->column();

         return $this->categories;
    }

    /**
     * метод для получения списка интервалов для поиска заданий по времени создания
     * @return array
     */
    public function getPeriod() : array
    {
        return self::PERIODS_VALUES;
    }

    public function attributeLabels()
    {
        return [
            'categories_id' => 'КАТЕГОРИИ',
            'period' => 'ПЕРИОД',
            'noDoer' => 'Без исполнителя',
            'search' => 'Искать',
        ];
    }

}