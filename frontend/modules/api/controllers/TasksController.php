<?php

namespace frontend\modules\api\controllers;

use common\models\Tasks;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class TasksController extends ActiveController
{
    public $modelClass = Tasks::class;

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'view') {
            /** @var $model Tasks */
            if ($model->create_user_id !== \Yii::$app->user->id) {
                throw new ForbiddenHttpException('Нельзя смотреть задачи где вы не являетесь автором');
            }
        }
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'except' => ['create']
        ];

        return $behaviors;
    }

    public function actionAuth()
    {
        return \Yii::$app->user->identity;
    }

    public function actionDataProvider()
    {
        $userId = \Yii::$app->user->id;
        return new ActiveDataProvider([
                'query' => Tasks::find()
                    ->where( [ 'create_user_id' => $userId ])
                    ->orWhere([ 'execute_user_id' => $userId ])
                    ->andWhere([ 'is_template' => false ]),
                'pagination' => [
                    'pageSizeLimit' => [ 10, 50 ],
                ],
            ]
        );
    }

    public function actionTemplates()
    {
        return new ActiveDataProvider([
                'query' => Tasks::find()->where([ 'is_template' => true ]),
                'pagination' => [
                    'pageSizeLimit' => [ 10, 50 ],
                ],
            ]
        );
    }
}