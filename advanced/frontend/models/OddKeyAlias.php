<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "odd_key_alias".
 *
 * @property integer $odd_key_alias_id
 * @property integer $sub_type_id
 * @property string $odd_key
 * @property string $odd_key_alias
 * @property string $special_bet_value
 */
class OddKeyAlias extends \yii\db\ActiveRecord {

    public $subTypeName;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'odd_key_alias';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['sub_type_id', 'odd_key', 'odd_key_alias'], 'required'],
            [['special_bet_value'], 'safe'],
            [['sub_type_id'], 'integer'],
            [['odd_key', 'odd_key_alias', 'special_bet_value'], 'string', 'max' => 10],
            [['sub_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => OddType::className(), 'targetAttribute' => ['sub_type_id' => 'sub_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'odd_key_alias_id' => 'Odd Key Alias ID',
            'sub_type_id' => 'Sub Type ID',
            'odd_key' => 'Odd Key',
            'odd_key_alias' => 'Odd Key Alias',
            'special_bet_value' => 'Special Bet Value',
        ];
    }

    public function getOddType() {
        return $this->hasOne(OddType::className(), ['sub_type_id' => 'sub_type_id']);
    }

    public function getTypeName() {
        return $this->oddType->name;
    }

    public function all_odd_types() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(name,' - ',sub_type_id) AS _oddtype", 'sub_type_id'])
                ->from('odd_type')
                ->all();
        foreach ($rows as $key => $value) {
            $data[$value['sub_type_id']] = $value['_oddtype'];
        }
        return $data;
    }

}
