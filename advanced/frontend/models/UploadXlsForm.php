<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadXlsForm extends Model {

    /**
     * @var UploadedFile
     */
    public $mediaFile;
    public $run;

    public function rules() {
        return [
            [
                ['mediaFile'],
                'file',
                'skipOnEmpty' => false,
                'maxSize' => 20000000,
                'tooBig' => 'Limit is 20MiB'],
            [ ['run'], 'safe'
            ],
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $upload_dlr = \Yii::getAlias('@frontend/runtime/deposits/');
            $this->mediaFile->saveAs($upload_dlr . $this->mediaFile->baseName . '.' . $this->mediaFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function uploadAirtel() {
        if ($this->validate()) {
            $upload_dlr = \Yii::getAlias('@frontend/runtime/airtel_deposits/');
            $this->mediaFile->saveAs($upload_dlr . $this->mediaFile->baseName . '.' . $this->mediaFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
