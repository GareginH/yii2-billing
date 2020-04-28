<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "billing".
 *
 * @property int $id
 * @property float|null $amount
 * @property int|null $user_id
 *
 * @property User $user
 */
class Billing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'billing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Сумма',
            'user_id' => 'ID Пользователя',
            'user.username' => 'Пользователь',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function store(){
        $billing = $this;
        $billing->amount = $this->amount;
        $billing->user_id = Yii::$app->user->getId();

        if($billing->save()){
            return true;
        }

        \Yii::error('Errors found'. VarDumper::dumpAsString($billing->errors));
        return false;
    }
}
