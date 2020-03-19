<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OddsSubtype]].
 *
 * @see OddsSubtype
 */
class OddsSubtypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return OddsSubtype[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OddsSubtype|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
