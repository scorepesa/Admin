<?php

namespace app\models;

use Yii;
use app\models\MtsException;
use app\models\MtsValidationCode;

/**
 * This is the model class for table "mts_ticket_submit".
 *
 * @property integer $mts_ticket_submit_id
 * @property integer $bet_id
 * @property string $mts_ticket
 * @property integer $status
 * @property string $response
 * @property string $message
 * @property string $created
 * @property string $modified
 */
class MtsTicketSubmit extends \yii\db\ActiveRecord {

    public $ValidationScenario;
    public $ValidationOutcome;
    public $MtsExceptionName;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'mts_ticket_submit';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['bet_id', 'mts_ticket', 'response', 'created'], 'required'],
            [['bet_id', 'status'], 'integer'],
            [['message'], 'string'],
            [['created', 'modified'], 'safe'],
            [['mts_ticket', 'response'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'mts_ticket_submit_id' => 'Mts Ticket Submit ID',
            'bet_id' => 'Bet ID',
            'mts_ticket' => 'Mts Ticket',
            'status' => 'Status',
            'response' => 'Response',
            'message' => 'Message',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMtsValidationCode() {
        return $this->hasOne(MtsValidationCode::className(), ['code' => 'response']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMtsException() {
        $condition = ['code' => $this->response];
        $data = MtsException::find()->select('name')
                        ->innerJoin('mts_validation_code', 'mts_exception.mts_exception_id=mts_validation_code.mts_exception_id')
                        ->where($condition)->one();
        return !empty($data) ? $data : "N/A";
    }

    public function getMtsExceptionName() {
        return $this->mtsException->name;
    }

    public function getValidationScenario() {
        return $this->mtsValidationCode->scenario;
    }

    public function getValidationOutcome() {
        return $this->mtsValidationCode->outcome;
    }

}
