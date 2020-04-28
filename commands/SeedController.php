<?php
// commands/SeedController.php
namespace app\commands;

use yii\console\Controller;
use app\models\User;
use app\models\Billing;
use yii\console\ExitCode;

class SeedController extends Controller
{
    public function actionIndex()
    {
        $faker = \Faker\Factory::create();
        echo "Пожалуйста подождите\n";
        for ( $i = 1; $i <= 15; $i++ )
        {
            echo $i."/15 готов \n";
            $user = new User();
            $billing = new Billing();
            $user->username = $faker->userName;
            $user->password = \Yii::$app->security->generatePasswordHash("123456");
            $user->accessToken = \Yii::$app->security->generateRandomString();
            $user->authKey = \Yii::$app->security->generateRandomString();
            if ( $user->save() )
            {
                $billing->setIsNewRecord(true);
                $billing->user_id = $user->id;
                $billing->amount = rand(100, 15000);
                $billing->save();
            }
        }
        echo "Готово, можете тестировать!\n";
        return ExitCode::OK;
    }
}