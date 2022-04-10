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

    const PERIOD_DEFAULT = 'Не выбран';
    const PERIOD_1 = '1 час';
    const PERIOD_12 = '12 часов';
    const PERIOD_24 = '24 часов';


    public function rules()
    {
        return [
            [['categories_id', 'noDoer', 'period', 'search'], 'safe']
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
        return [
            self::PERIOD_DEFAULT => 'Не выбран',
            self::PERIOD_1 => '1 час',
            self::PERIOD_12 =>'12 часов',
            self::PERIOD_24 => '24 часа',

        ];
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