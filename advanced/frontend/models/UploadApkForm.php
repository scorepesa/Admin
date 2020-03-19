<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadApkForm extends Model {

    /**
     * @var UploadedFile
     */
    public $apkFile;
    public $run;

    public function rules() {
        return [
            [
                ['apkFile'],
                'file',
                'skipOnEmpty' => false,
                'maxSize' => 20000000,
                'tooBig' => 'Limit is 20MiB'],
            [['run'], 'safe'
            ],
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $upload_dlr = \Yii::getAlias('@frontend/runtime/androidapk/');
            $this->apkFile->saveAs($upload_dlr . $this->apkFile->baseName . '.' . $this->apkFile->extension);
            return true;
        } else {
            return false;
        }
    }

}
