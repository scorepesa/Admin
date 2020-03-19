<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IncomingMatch]].
 *
 * @see IncomingMatch
 */
class IncomingMatchQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return IncomingMatch[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return IncomingMatch|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
