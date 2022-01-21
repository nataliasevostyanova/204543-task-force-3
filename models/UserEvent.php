<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userevent".
 *
 * @property int $id id события
 * @property int $doer_id id  исполнителя
 * @property int $task_id id  задания
 * @property string|null $event наименование события
 *
 * @property User $doer
 * @property Task $task
 */
class UserEvent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userevent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doer_id', 'task_id'], 'required'],
            [['doer_id', 'task_id'], 'integer'],
            [['event'], 'string', 'max' => 120],
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
            'id' => Yii::t('app', 'id события'),
            'doer_id' => Yii::t('app', 'id  исполнителя'),
            'task_id' => Yii::t('app', 'id  задания'),
            'event' => Yii::t('app', 'наименование события'),
        ];
    }

    /**
     * Gets query for [[Doer]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getDoer()
    {
        return $this->hasOne(User::className(), ['id' => 'doer_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery|TaskQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserEventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserEventQuery(get_called_class());
    }
}
