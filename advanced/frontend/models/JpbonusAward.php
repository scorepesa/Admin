<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jpbonus_award".
 *
 * @property integer $id
 * @property integer $jackpot_event_id
 * @property integer $total_games_correct
 * @property string $jackpot_bonus
 * @property string $scorepesa_points_bonus
 * @property string $created_by
 * @property string $created
 * @property string $modified
 */
class JpbonusAward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jpbonus_award';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jackpot_event_id', 'total_games_correct', 'jackpot_bonus', 'scorepesa_points_bonus', 'created_by', 'approved_by','created'], 'required'],
            [['jackpot_event_id', 'total_games_correct'], 'integer'],
            [['jackpot_bonus', 'scorepesa_points_bonus'], 'number'],
            [['created', 'modified'], 'safe'],
            [['created_by'], 'string', 'max' => 255],
            [['approved_by'], 'string', 'max' => 255],
            [['jackpot_event_id', 'total_games_correct'], 
                'unique', 'targetAttribute' => ['jackpot_event_id', 'total_games_correct'], 
                 'message' => 'The combination of Jackpot Event ID and Total Games Correct has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jackpot_event_id' => 'Jackpot Event ID',
            'total_games_correct' => 'Total Games Correct',
            'jackpot_bonus' => 'Jackpot Bonus',
            'scorepesa_points_bonus' => 'Scorepesa Points Bonus',
            'created_by' => 'Created By',
            'approved_by' => 'Approved By',
            'status' => 'Status',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJackpotEvents()
    {
        return $this->hasMany(JackpotEvent::className(), ['jackpot_event' => 'jackpot_event_id']);
    }

     public function awardJackpotBonus($jackpot_event_id, $total_games_correct,$jackpot_bonus, $scorepesa_points_bonus, $created_by) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try{
               
                $status = 0;
                $approved_by = '';
                $created = date('Y-m-d H:i:s');
                $sql = "INSERT INTO jpbonus_award(jackpot_event_id,total_games_correct,jackpot_bonus,scorepesa_points_bonus,status,created_by,approved_by,created)  VALUES('$jackpot_event_id','$total_games_correct','$jackpot_bonus','$scorepesa_points_bonus','$status','$created_by','$approved_by','$created')";
                
                $connection->createCommand($sql)->execute();

                $transaction->commit();
                
                return TRUE;
        
        } catch (Exception $exc) {
            $transaction->rollback();
            return FALSE;
        }
        
    }

    public function approveBonusAward($id,$approvedBy) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try{
               
                $sql = "UPDATE jpbonus_award SET status = 1, approved_by = '$approvedBy' WHERE id = '$id' ";
                
                $connection->createCommand($sql)->execute();

                $transaction->commit();
                
                return TRUE;
        
        } catch (Exception $exc) {
            $transaction->rollback();
            return FALSE;
        }
        
    }
   
   public function event_to_award() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(jackpot_event_id, ' - ' ,jackpot_name) AS _event", 'jackpot_event_id'])
                ->from('jackpot_event')
                ->where(['status'=>'FINISHED'])
                ->all();
        foreach ($rows as $key => $value) {
            $data[$value['jackpot_event_id']] = $value['_event'];
        }
        return $data;
    }

}
