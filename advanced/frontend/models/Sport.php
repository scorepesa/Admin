<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sport".
 *
 * @property integer $sport_id
 * @property string $sport_name
 * @property string $created_by
 * @property string $created
 * @property string $modified
 *
 * @property Competition[] $competitions
 */
class Sport extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sport';
    }

    public static function getDb() {
        return Yii::$app->db;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['sport_name', 'created_by', 'created'], 'required'],
            [['created', 'modified'], 'safe'],
            [['sport_name'], 'string', 'max' => 50],
            [['created_by'], 'string', 'max' => 70],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'sport_id' => 'Sport ID',
            'sport_name' => 'Sport Name',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompetitions() {
        return $this->hasMany(Competition::className(), ['sport_id' => 'sport_id']);
    }

    /**
     * @inheritdoc
     * @return SportQuery the active query used by this AR class.
     */
    public static function find() {
        return new SportQuery(get_called_class());
    }

}
