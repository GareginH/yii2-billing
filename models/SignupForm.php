<?php


namespace app\models;
use yii\base\Model;
use yii\helpers\VarDumper;

class SignupForm extends Model
{
    public $email;
    public $password;
    public $password_repeat;
    public $username;

    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat'], 'required'],
            ['username', 'string', 'min'=>4, 'max'=> 50],
            [['password', 'password_repeat'], 'string', 'min'=>5],
            ['password_repeat', 'compare', 'compareAttribute'=>'password']
        ];
    }

    public function signup()
    {

        $user = new User();
        $user->username = $this->username;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->accessToken = \Yii::$app->security->generateRandomString();
        $user->authKey = \Yii::$app->security->generateRandomString();

        if($user->save()){

            return true;
        }

        \Yii::error('Errors found'. VarDumper::dumpAsString($user->errors));
        return false;
    }
}