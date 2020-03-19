<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bet".
 *
 * @property integer $bet_id
 * @property integer $profile_id
 * @property string $bet_message
 * @property string $total_odd
 * @property string $bet_amount
 * @property string $possible_win
 * @property integer $status
 * @property integer $win
 * @property string $reference
 * @property string $created_by
 * @property string $created
 * @property string $modified
 *
 * @property ProfileMap $profile
 * @property BetSlip[] $betSlips
 * @property BonusBet[] $bonusBets
 * @property JackpotBet[] $jackpotBets
 * @property JackpotWinner[] $jackpotWinners
 * @property Winner[] $winners
 */
class VirtualsBet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bet';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('virtualsdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'bet_message', 'total_odd', 'bet_amount', 'possible_win', 'status', 'reference', 'created_by', 'created'], 'required'],
            [['profile_id', 'status', 'win'], 'integer'],
            [['bet_message'], 'string'],
            [['total_odd', 'bet_amount', 'possible_win'], 'number'],
            [['created', 'modified'], 'safe'],
            [['reference', 'created_by'], 'string', 'max' => 70],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProfileMap::className(), 'targetAttribute' => ['profile_id' => 'scorepesa_profile_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bet_id' => 'Bet ID',
            'profile_id' => 'Profile ID',
            'bet_message' => 'Bet Message',
            'total_odd' => 'Total Odd',
            'bet_amount' => 'Bet Amount',
            'possible_win' => 'Possible Win',
            'status' => 'Status',
            'win' => 'Win',
            'reference' => 'Reference',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(ProfileMap::className(), ['scorepesa_profile_id' => 'profile_id']);
    }

    public function getProfileName() {
        return $this->profile->scorepesa_profile_id;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBetSlips()
    {
        return $this->hasMany(BetSlip::className(), ['bet_id' => 'bet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBonusBets()
    {
        return $this->hasMany(BonusBet::className(), ['bet_id' => 'bet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJackpotBets()
    {
        return $this->hasMany(JackpotBet::className(), ['bet_id' => 'bet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJackpotWinners()
    {
        return $this->hasMany(JackpotWinner::className(), ['bet_id' => 'bet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWinners()
    {
        return $this->hasMany(Winner::className(), ['bet_id' => 'bet_id']);
    }

    public function betdetail($bet_id) {
        $connection = $this->db;
        $sql = "SELECT b.bet_id, b.reference, s.live_bet FROM bet b INNER JOIN bet_slip s USING(bet_id) "
                . "WHERE b.bet_id = $bet_id";
        $data = $connection->createCommand($sql)->queryAll();

        foreach ($data as $value) {
            return $value;
        }
    }

}
