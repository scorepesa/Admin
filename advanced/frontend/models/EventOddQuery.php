<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MatchBet]].
 *
 * @see MatchBet
 */
class EventOddQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MatchBet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MatchBet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
