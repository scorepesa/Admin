<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Inbox]].
 *
 * @see Inbox
 */
class InboxQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Inbox[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Inbox|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
