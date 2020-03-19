<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jackpot_type".
 *
 * @property integer $jackpot_type_id
 * @property string $name
 *
 * @property JackpotEvent[] $jackpotEvents
 */
class JackpotType extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'jackpot_type';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'sub_type_id'], 'required'],
            [['name'], 'string', 'max' => 250],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'jackpot_type_id' => 'Jackpot Type ID',
            'sub_type_id' =>'Sub type ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJackpotEvents() {
        return $this->hasMany(JackpotEvent::className(), ['jackpot_type' => 'jackpot_type_id']);
    }

    public function all_odd_types() {
        $data = array();
        $rows = array(
                  ['sub_type_id'=>45, '_oddtype'=>'Correct Score'],
                  ['sub_type_id'=>1, '_oddtype'=>'3 Way']
                );
                /** (new \yii\db\Query())
                ->select(["CONCAT(name,' - ',sub_type_id) AS _oddtype", 'sub_type_id'])
                ->from('odd_type')
                ->all(); **/
        foreach ($rows as $key => $value) {
            $data[$value['sub_type_id']] = $value['_oddtype'];
        }
        return $data;
    }

}
