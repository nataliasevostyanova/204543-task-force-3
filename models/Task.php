<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id id задания
 * @property string $created_date время создания задания
 * @property int $client_id id заказчика
 * @property int|null $doer_id id  исполнителя
 * @property int $town_id почтовый индекс города
 * @property float $latitude широта города (географ.)
 * @property float $longitude долгота города (географ.)
 * @property string $title название задания
 * @property string $description описание задания
 * @property int $category_id категория работ
 * @property int $budget бюджет/стоимость работ
 * @property string $finish_date дата окончания работ
 * @property string $task_status статус задания
 *
 * @property Category $category
 * @property User $client
 * @property User $doer
 * @property Respond[] $responds
 * @property Review[] $reviews
 * @property Town $town
 * @property Userevent[] $userevents
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_date', 'client_id', 'town_id', 'latitude', 'longitude', 'title', 'description', 'category_id', 'budget', 'finish_date', 'task_status'], 'required'],
            [['created_date', 'finish_date'], 'safe'],
            [['client_id', 'doer_id', 'town_id', 'category_id', 'budget'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['title'], 'string', 'max' => 200],
            [['description'], 'string', 'max' => 450],
            [['task_status'], 'string', 'max' => 120],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['doer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['doer_id' => 'id']],
            [['town_id'], 'exist', 'skipOnError' => true, 'targetClass' => Town::className(), 'targetAttribute' => ['town_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id задания'),
            'created_date' => Yii::t('app', 'время создания задания'),
            'client_id' => Yii::t('app', 'id заказчика'),
            'doer_id' => Yii::t('app', 'id  исполнителя'),
            'town_id' => Yii::t('app', 'почтовый индекс города'),
            'latitude' => Yii::t('app', 'широта города (географ.)'),
            'longitude' => Yii::t('app', 'долгота города (географ.)'),
            'title' => Yii::t('app', 'название задания'),
            'description' => Yii::t('app', 'описание задания'),
            'category_id' => Yii::t('app', 'категория работ'),
            'budget' => Yii::t('app', 'бюджет/стоимость работ'),
            'finish_date' => Yii::t('app', 'дата окончания работ'),
            'task_status' => Yii::t('app', 'статус задания'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(User::className(), ['id' => 'client_id']);
    }

    /**
     * Gets query for [[Doer]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getDoer()
    {
        return $this->hasOne(User::className(), ['id' => 'doer_id']);
    }

    /**
     * Gets query for [[Responds]].
     *
     * @return \yii\db\ActiveQuery|RespondQuery
     */
    public function getResponds()
    {
        return $this->hasMany(Respond::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery|ReviewQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Town]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getTown()
    {
        return $this->hasOne(Town::className(), ['id' => 'town_id']);
    }

    /**
     * Gets query for [[Userevents]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUserevents()
    {
        return $this->hasMany(Userevent::className(), ['task_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskQuery(get_called_class());
    }
}
