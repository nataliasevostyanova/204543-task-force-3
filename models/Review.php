<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id id отзыва
 * @property int $client_id id заказчика
 * @property int $task_id id задания
 * @property int $doer_id id исполнителя
 * @property string $review_content содержание отзыва
 * @property int|null $stars оценка выполнения задания 1-5 звёзд
 * @property string|null $create_date время создания отзыва
 *
 * @property User $client
 * @property User $doer
 * @property Task $task
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'task_id', 'doer_id', 'review_content'], 'required'],
            [['client_id', 'task_id', 'doer_id', 'stars'], 'integer'],
            [['create_date'], 'safe'],
            [['review_content'], 'string', 'max' => 450],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['doer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['doer_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id отзыва'),
            'client_id' => Yii::t('app', 'id заказчика'),
            'task_id' => Yii::t('app', 'id задания'),
            'doer_id' => Yii::t('app', 'id исполнителя'),
            'review_content' => Yii::t('app', 'содержание отзыва'),
            'stars' => Yii::t('app', 'оценка выполнения задания 1-5 звёзд'),
            'create_date' => Yii::t('app', 'время создания отзыва'),
        ];
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
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * {@inheritdoc}
     * @return ReviewQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReviewQuery(get_called_class());
    }
}
