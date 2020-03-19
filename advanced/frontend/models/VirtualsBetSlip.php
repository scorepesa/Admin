<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bet_slip".
 *
 * @property integer $bet_slip_id
 * @property integer $parent_match_id
 * @property integer $bet_id
 * @property string $bet_pick
 * @property string $special_bet_value
 * @property integer $total_games
 * @property string $odd_value
 * @property integer $win
 * @property integer $live_bet
 * @property string $created
 * @property string $modified
 * @property integer $status
 * @property integer $sub_type_id
 *
 * @property Bet $bet
 */
class VirtualsBetSlip extends \yii\db\ActiveRecord
{

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
    public static function tableName()
    {
        return 'bet_slip';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_match_id', 'bet_id', 'total_games', 'odd_value', 'win', 'created', 'status', 'sub_type_id'], 'required'],
            [['parent_match_id', 'bet_id', 'total_games', 'win', 'live_bet', 'status', 'sub_type_id'], 'integer'],
            [['odd_value'], 'number'],
            [['created', 'modified'], 'safe'],
            [['bet_pick'], 'string', 'max' => 250],
            [['special_bet_value'], 'string', 'max' => 20],
            [['bet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bet::className(), 'targetAttribute' => ['bet_id' => 'bet_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bet_slip_id' => 'Bet Slip ID',
            'parent_match_id' => 'Parent Match ID',
            'bet_id' => 'Bet ID',
            'bet_pick' => 'Bet Pick',
            'special_bet_value' => 'Special Bet Value',
            'total_games' => 'Total Games',
            'odd_value' => 'Odd Value',
            'win' => 'Win',
            'live_bet' => 'Live Bet',
            'created' => 'Created',
            'modified' => 'Modified',
            'status' => 'Status',
            'sub_type_id' => 'Sub Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBet() {
        return $this->hasOne(VirtualsBet::className(), ['bet_id' => 'bet_id']);
    }

    public function getBetMessage() {
        return $this->bet->bet_message;
    }

    public function getMatch() {
        return $this->parentMatch->home_team . ' VS ' . $this->parentMatch->away_team;
    }

    public function getHome_team() {
        return $this->parentMatch->home_team;
    }

    public function getAway_team() {
        return $this->parentMatch->away_team;
    }

    public function getHtFtScore() {
        return $this->parentMatch->ht_score . ' - ' . $this->parentMatch->ft_score;
    }

    public function getSubType() {
        return $this->hasOne(VirtualOddType::className(), ['sub_type_id' => 'sub_type_id']);
    }

    public function getResultingSubType() {
        return $this->hasOne(VirtualOddType::className(), ['sub_type_id' => 'sub_type_id']);
    }

    public function getGameId() {
        return $this->parentMatch->game_id;
    }

    public function getSubtypeName() {
        return $result = isset($this->subType->name) ? $this->subType->name : "";
    }

    public function getResultingSubtypeName() {
        return $result = isset($this->resultingSubType->name) ? $this->resultingSubType->name : "";
    }

    public function getOutcome() {
        return $this->hasMany(VirtualsOutcome::className(), ['parent_virtual_id' => 'parent_match_id',
                    'sub_type_id' => 'sub_type_id', 'special_bet_value' => 'special_bet_value']);
    }

    public function getOutcomeValue() {
        $data = "";

        if ($this->outcome) {
            $str = "";
            foreach ($this->outcome as $value) {
                $data .= $str . $value->winning_outcome;
                $str = ",";
            }
            return $data;
        }
        return 'N/A';
    }

    public function getPossibleOutcome() {
        $result = VirtualEventOdd::find()->where(['parent_virtual_id' => $this->parent_match_id, 'sub_type_id' => $this->sub_type_id]);
        return $result->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentMatch() {
        return $this->hasOne(VirtualMatch::className(), ['parent_virtual_id' => 'parent_match_id']);
    }


}
