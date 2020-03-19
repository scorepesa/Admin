<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MpesaTransaction]].
 *
 * @see MpesaTransaction
 */
class MpesaTransactionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MpesaTransaction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MpesaTransaction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
