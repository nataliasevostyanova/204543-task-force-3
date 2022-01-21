<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id id пользователя
 * @property string $full_name имя и фамилия пользователя
 * @property string|null $sign_date дата и время создания аккаунта
 * @property string $role роль: заказчик или исполнитель
 * @property string $phone номер телефона пользователя
 * @property string $email email пользователя
 * @property string|null $telegram telegram пользователя
 * @property string $password пароль к аккаунту
 * @property string|null $avatar URL аватара пользователя
 * @property string|null $about_user рассказ исполнителя о себе
 * @property string|null $birthdate дата рождения
 * @property int|null $town_id почтовый код города
 *
 * @property Category[] $categories
 * @property Respond[] $responds
 * @property Review[] $reviews
 * @property Review[] $reviews0
 * @property Task[] $tasks
 * @property Task[] $tasks0
 * @property Town $town
 * @property UserCategory[] $userCategories
 * @property Userevent[] $userevents
 * @property Userimage[] $userimages
 * @property Userstatistic $userstatistic
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'role', 'phone', 'email', 'password'], 'required'],
            [['sign_date', 'birthdate'], 'safe'],
            [['town_id'], 'integer'],
            [['full_name', 'avatar'], 'string', 'max' => 200],
            [['role', 'password'], 'string', 'max' => 100],
            [['phone', 'email', 'telegram'], 'string', 'max' => 120],
            [['about_user'], 'string', 'max' => 450],
            [['email'], 'unique'],
            [['phone'], 'unique'],
            [['town_id'], 'exist', 'skipOnError' => true, 'targetClass' => Town::className(), 'targetAttribute' => ['town_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id пользователя'),
            'full_name' => Yii::t('app', 'имя и фамилия пользователя'),
            'sign_date' => Yii::t('app', 'дата и время создания аккаунта'),
            'role' => Yii::t('app', 'роль: заказчик или исполнитель'),
            'phone' => Yii::t('app', 'номер телефона пользователя'),
            'email' => Yii::t('app', 'email пользователя'),
            'telegram' => Yii::t('app', 'telegram пользователя'),
            'password' => Yii::t('app', 'пароль к аккаунту'),
            'avatar' => Yii::t('app', 'URL аватара пользователя'),
            'about_user' => Yii::t('app', 'рассказ исполнителя о себе'),
            'birthdate' => Yii::t('app', 'дата рождения'),
            'town_id' => Yii::t('app', 'почтовый код города'),
        ];
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery|CategoryQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('user_category', ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Responds]].
     *
     * @return \yii\db\ActiveQuery|RespondQuery
     */
    public function getResponds()
    {
        return $this->hasMany(Respond::className(), ['doer_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery|ReviewQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['client_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews0]].
     *
     * @return \yii\db\ActiveQuery|ReviewQuery
     */
    public function getReviews0()
    {
        return $this->hasMany(Review::className(), ['doer_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery|TaskQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['client_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery|TaskQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Task::className(), ['doer_id' => 'id']);
    }

    /**
     * Gets query for [[Town]].
     *
     * @return \yii\db\ActiveQuery|TownQuery
     */
    public function getTown()
    {
        return $this->hasOne(Town::className(), ['id' => 'town_id']);
    }

    /**
     * Gets query for [[UserCategories]].
     *
     * @return \yii\db\ActiveQuery|UserCategoryQuery
     */
    public function getUserCategories()
    {
        return $this->hasMany(UserCategory::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Userevents]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUserevents()
    {
        return $this->hasMany(Userevent::className(), ['doer_id' => 'id']);
    }

    /**
     * Gets query for [[Userimages]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUserimages()
    {
        return $this->hasMany(Userimage::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Userstatistic]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUserstatistic()
    {
        return $this->hasOne(Userstatistic::className(), ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
