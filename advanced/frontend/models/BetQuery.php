<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Bet]].
 *
 * @see Bet
 */
class BetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Bet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Bet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
