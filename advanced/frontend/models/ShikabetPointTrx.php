<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scorepesa_point_trx".
 *
 * @property integer $scorepesa_point_trx_id
 * @property integer $trx_id
 * @property string $points
 * @property string $trx_type
 * @property string $status
 * @property string $created
 * @property string $modified
 */
class ScorepesaPointTrx extends \yii\db\ActiveRecord {

    public $profileId;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'scorepesa_point_trx';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['trx_id', 'points', 'trx_type', 'status', 'created'], 'required'],
            [['trx_id', 'profileId'], 'integer'],
            [['points'], 'number'],
            [['trx_type', 'status'], 'string'],
            [['created', 'modified'], 'safe'],
            [['trx_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'scorepesa_point_trx_id' => 'Scorepesa Point Trx ID',
            'trx_id' => 'Trx ID',
            'points' => 'Points',
            'trx_type' => 'Trx Type',
            'status' => 'Status',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

}
