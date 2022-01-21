<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "town".
 *
 * @property int $id id города
 * @property string $city название города
 * @property float|null $latitude географ. широта города
 * @property float|null $longitude географ. долгота города
 *
 * @property Task[] $tasks
 * @property User[] $users
 */
class Town extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'town';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['city'], 'string', 'max' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id города'),
            'city' => Yii::t('app', 'название города'),
            'latitude' => Yii::t('app', 'географ. широта города'),
            'longitude' => Yii::t('app', 'географ. долгота города'),
        ];
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery|TaskQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['town_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['town_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TownQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TownQuery(get_called_class());
    }
}
