<?php

namespace console\controllers;

use common\models\User;

class RbacController extends \yii\console\Controller
{
    /**
     * php yii rbac/init
     * @throws \Exception
     */
    public function actionInit()
    {
        $role = \Yii::$app->authManager->createRole('admin');
        $role->description = 'admin';
        \Yii::$app->authManager->add($role);
    }

    public function actionAddAdmin($username)
    {
        $user = User::find()->where([ 'username' => $username ])->one();

        if (empty($user)) {
            $user = new User();
            $user->username = $username;
            $user->email = "$username@default.com";
            $user->setPassword( $username );
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            if ($user->save()) {
                echo "user created password: $username \nplease change your password!!!";
            }
        }
        $adminRole = \Yii::$app->authManager->getRole('admin');
        \Yii::$app->authManager->assign($adminRole, $user->id);
    }
}