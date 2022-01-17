<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Respond]].
 *
 * @see Respond
 */
class RespondQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Respond[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Respond|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
