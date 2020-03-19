<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bleague_competition".
 *
 * @property integer $competition_id
 * @property string $competition_name
 * @property string $category
 * @property integer $status
 * @property integer $sport_id
 * @property string $created_by
 * @property string $created
 * @property string $modified
 * @property integer $priority
 * @property string $max_stake
 */
class BleagueCompetition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bleague_competition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['competition_name', 'category', 'status', 'sport_id', 'created_by', 'created'], 'required'],
            [['status', 'sport_id', 'priority'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['max_stake'], 'number'],
            [['competition_name', 'category'], 'string', 'max' => 120],
            [['created_by'], 'string', 'max' => 70],
            [['competition_name', 'category', 'sport_id'], 'unique', 'targetAttribute' => ['competition_name', 'category', 'sport_id'], 'message' => 'The combination of Competition Name, Category and Sport ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'competition_id' => 'Competition ID',
            'competition_name' => 'Competition Name',
            'category' => 'Competition Category',
            'status' => 'Status',
            'sport_id' => 'Sport ID',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
            'priority' => 'Priority',
            'max_stake' => 'Max Stake',
        ];
    }

    public function fetch_sports() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(sport_name, ' - ',sport_id) AS _sport", 'sport_id'])
                ->from('bleague_sport')
                ->all();
                
        foreach ($rows as $key => $value) {
            $data[$value['sport_id']] = $value['_sport'];
        }
        return $data;
    }
}
