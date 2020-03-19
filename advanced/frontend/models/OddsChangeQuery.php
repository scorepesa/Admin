<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OddsChange]].
 *
 * @see OddsChange
 */
class OddsChangeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return OddsChange[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OddsChange|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
