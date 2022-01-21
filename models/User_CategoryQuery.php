<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[User_Category]].
 *
 * @see User_Category
 */
class User_CategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return User_Category[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return User_Category|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
