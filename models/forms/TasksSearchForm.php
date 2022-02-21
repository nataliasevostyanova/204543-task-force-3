<?php

namespace app\models\forms;

use yii\base\Model;
use app\models\Task;
use TaskForce\TaskStatus;
use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;


class TasksSearchForm extends Model
{
    public $categories;
    public $noDoer;
    public $period;
    public $search;

    //нужны ли константы?
    const PERIOD_1 = '1 час';
    const PERIOD_12 = '12 часов';
    const PERIOD_24 = '24 часов';

    public function rules()
    {
        return [
            [['categories', 'noDoer', 'period', 'search'], 'safe']
        ];
    }

    /**
     * метод для получения списка категорий для формы поиска заданий по категориям
     * @return array
     */
    public function getCategoriesList() : array
    {
        $this->categories = Category::find()
            ->select( 'id','name')
            ->all();
        return ArrayHelper::map($this->categories, 'id', 'name');
    }
    /**
     * метод для получения списка интервалов для поиска заданий по времени создания
     * @return array
     */
    public function getPeriod() : array
    {
        return [
            self::PERIOD_1 => '1 час',
            self::PERIOD_12 =>'12 часов',
            self::PERIOD_24 => '24 часа',
        ];
    }

    public function attributeLabels()
    {
        return [
            'categories' => 'КАТЕГОРИИ',
            'period' => 'ПЕРИОД',
            'noDoer' => 'Без исполнителя',
            'search' => 'Искать',
        ];
    }

    public function getTasksSearch()
    {

        $tasks = Task::find()
            ->with([ 'town', 'category'])
            ->where(['task_status' => TaskStatus::STATUS_NEW])
            ->orderBy(['created_date' => SORT_DESC])
            ->all();

       /* if(Carbon::diffInHours($tasks->created_date) <= $period) {

        }*/

        $dataProvider = new ActiveDataProvider([
            'query' => $tasks,
            'pagination' => [
                'pageSize' => 3,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        return $dataProvider;
    }

    public function getPeriod


}