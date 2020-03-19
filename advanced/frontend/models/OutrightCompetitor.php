<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outright_competitor".
 *
 * @property integer $competitor_id
 * @property integer $parent_outright_id
 * @property integer $betradar_competitor_id
 * @property integer $betradar_super_id
 * @property string $competitor_name
 * @property integer $status
 * @property integer $priority
 * @property string $created_by
 * @property string $created
 * @property string $modified
 */
class OutrightCompetitor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outright_competitor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_outright_id', 'betradar_competitor_id', 'betradar_super_id', 'competitor_name', 'created_by', 'created'], 'required'],
            [['parent_outright_id', 'betradar_competitor_id', 'betradar_super_id', 'status', 'priority'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['competitor_name'], 'string', 'max' => 100],
            [['created_by'], 'string', 'max' => 60],
            [['parent_outright_id', 'betradar_competitor_id'], 'unique', 'targetAttribute' => ['parent_outright_id', 'betradar_competitor_id'], 'message' => 'The combination of Parent Outright ID and Betradar Competitor ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'competitor_id' => 'Competitor ID',
            'parent_outright_id' => 'Parent Outright ID',
            'betradar_competitor_id' => 'Betradar Competitor ID',
            'betradar_super_id' => 'Betradar Super ID',
            'competitor_name' => 'Competitor Name',
            'status' => 'Status',
            'priority' => 'Priority',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
