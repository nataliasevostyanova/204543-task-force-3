<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respond".
 *
 * @property int $id id отклика
 * @property int $task_id id задания
 * @property int $doer_id id  исполнителя
 * @property int $execute_budget бюджет/стоимость работ
 * @property string $comment текст  отклика на задание
 * @property string|null $created_at время создания отклика на задание
 *
 * @property User $doer
 * @property Task $task
 */
class Respond extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'respond';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'doer_id', 'execute_budget', 'comment'], 'required'],
            [['task_id', 'doer_id', 'execute_budget'], 'integer'],
            [['created_at'], 'safe'],
            [['comment'], 'string', 'max' => 255],
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
            'id' => Yii::t('app', 'id отклика'),
            'task_id' => Yii::t('app', 'id задания'),
            'doer_id' => Yii::t('app', 'id  исполнителя'),
            'execute_budget' => Yii::t('app', 'бюджет/стоимость работ'),
            'comment' => Yii::t('app', 'текст  отклика на задание'),
            'created_at' => Yii::t('app', 'время создания отклика на задание'),
        ];
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
     * @return RespondQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RespondQuery(get_called_class());
    }
}
