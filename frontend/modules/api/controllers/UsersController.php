<?php

namespace frontend\modules\api\controllers;

use common\models\Tasks;
use common\models\User;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class UsersController extends ActiveController
{
    public $modelClass = User::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'except' => ['create']
        ];

        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'update') {
            /** @var $model Tasks */
            if ( $model->id !== \Yii::$app->user->id &&  !\Yii::$app->user->can('admin') ) {
                throw new ForbiddenHttpException('Доступ запрещен');
            }
        }
    }

    public function actionAuth()
    {
        return \Yii::$app->user->identity;
    }
}