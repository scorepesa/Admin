<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mpesa_rate".
 *
 * @property integer $id
 * @property double $min_amount
 * @property double $max_amount
 * @property double $charge
 * @property string $created
 * @property string $updated
 */
class MpesaRate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mpesa_rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['min_amount', 'max_amount', 'charge'], 'required'],
            [['min_amount', 'max_amount', 'charge'], 'number'],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'min_amount' => 'Min Amount',
            'max_amount' => 'Max Amount',
            'charge' => 'Charge',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
