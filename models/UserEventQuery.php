<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserEvent]].
 *
 * @see UserEvent
 */
class UserEventQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserEvent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserEvent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
