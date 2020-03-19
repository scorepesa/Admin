<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Winner]].
 *
 * @see Winner
 */
class WinnerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Winner[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Winner|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
