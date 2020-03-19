<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LiveOdds]].
 *
 * @see LiveOdds
 */
class LiveOddsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LiveOdds[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LiveOdds|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
