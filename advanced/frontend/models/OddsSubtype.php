<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "odds_subtype".
 *
 * @property integer $odds_subtype_id
 * @property integer $subtype
 * @property string $freetext
 * @property string $created
 */
class OddsSubtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'odds_subtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subtype', 'freetext'], 'required'],
            [['subtype'], 'integer'],
            [['freetext'], 'string'],
            [['created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'odds_subtype_id' => Yii::t('app', 'Odds Subtype ID'),
            'subtype' => Yii::t('app', 'Subtype'),
            'freetext' => Yii::t('app', 'Freetext'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @inheritdoc
     * @return OddsSubtypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OddsSubtypeQuery(get_called_class());
    }
}
