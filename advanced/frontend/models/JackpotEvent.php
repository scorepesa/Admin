<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jackpot_event".
 *
 * @property integer $jackpot_event_id
 * @property integer $jackpot_type
 * @property string $jackpot_name
 * @property string $created_by
 * @property string $status
 * @property string $bet_amount
 * @property integer $total_games
 * @property string $created
 * @property string $modified
 *
 * @property JackpotBet[] $jackpotBets
 * @property JackpotType $jackpotType
 * @property JackpotTrx[] $jackpotTrxes
 * @property JackpotWinner[] $jackpotWinners
 */
class JackpotEvent extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'jackpot_event';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['jackpot_type', 'jackpot_name', 'jackpot_amount', 'jp_key', 'created_by', 'bet_amount', 'total_games', 'created'], 'required'],
            [['jackpot_type', 'total_games'], 'integer'],
            [['status'], 'string'],
            [['bet_amount', 'requisite_wins'], 'number'],
            [['created', 'modified'], 'safe'],
            [['jackpot_name'], 'string', 'max' => 250],
            [['created_by'], 'string', 'max' => 70],
            [['jackpot_name'], 'unique'],
            [['jackpot_type'], 'exist', 'skipOnError' => true, 'targetClass' => JackpotType::className(), 'targetAttribute' => ['jackpot_type' => 'jackpot_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'jackpot_event_id' => 'Jackpot Event ID',
            'jackpot_type' => 'Jackpot Type',
            'jackpot_name' => 'Jackpot Name',
            'created_by' => 'Created By',
            'status' => 'Status',
            'bet_amount' => 'Bet Amount',
            'total_games' => 'Total Games',
            'created' => 'Created',
            'modified' => 'Modified',
            'jackpot_amount' => 'Jackpot Amount',
            'requisite_wins' => 'Requisite Wins',
            'jp_key' => 'Jackpot Key'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJackpotBets() {
        return $this->hasMany(JackpotBet::className(), ['jackpot_event_id' => 'jackpot_event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJackpotType() {
        return $this->hasOne(JackpotType::className(), ['jackpot_type_id' => 'jackpot_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJackpotTrxes() {
        return $this->hasMany(JackpotTrx::className(), ['jackpot_event_id' => 'jackpot_event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJackpotWinners() {
        return $this->hasMany(JackpotWinner::className(), ['jackpot_event_id' => 'jackpot_event_id']);
    }

    public function jackpot_types() {
        //$start_datetime = $this->jackpot_event_starttime();
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('jackpot_type')
                ->all();
        /* ->createCommand();
          echo print_r($rows->sql);
          die(); */
        foreach ($rows as $key => $value) {
            $data[$value['jackpot_type_id']] = $value['name'];
        }
        return $data;
    }

    public function jackpot_event() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('jackpot_event')
                ->where(["status" => 'FINISHED'])
                ->andWhere('created >= date_sub(now(), interval 1000 hour)')
                ->all();
               
        foreach ($rows as $key => $value) {
            $data[$value['jackpot_event_id']] = $value['jackpot_name'];
        }
        return $data;
    }

}
