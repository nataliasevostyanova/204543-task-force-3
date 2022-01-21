<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userimage".
 *
 * @property int $id id загруженного файла
 * @property int $user_id id пользователя, кто размещает файлы
 * @property string|null $file_url url размещения загруженного файла
 *
 * @property User $user
 */
class UserImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userimage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['file_url'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id загруженного файла'),
            'user_id' => Yii::t('app', 'id пользователя, кто размещает файлы'),
            'file_url' => Yii::t('app', 'url размещения загруженного файла'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserImageQuery(get_called_class());
    }
}
