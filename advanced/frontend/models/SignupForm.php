<?php

namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $result = $user->save() ? $user : null;

        if (!is_null($result)) {
            //send credentials email to user
            $this->sendEmail($result);
        }

        return $result;
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail($user) {

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'signupCredentials-html', 'text' => 'signupCredentials-text'],
                ['user' => $user, 'rawpassword' => $this->password]
            )
            ->setFrom([\Yii::$app->params['supportEmail'] => 'tech@roamtech.com'])
            ->setTo($user->email)
            ->setSubject('User Credentials for ' . \Yii::$app->name)
            ->send();

    }


}
