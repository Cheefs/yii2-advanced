<?php

namespace frontend\modules\api\controllers;

use common\models\Projects;

use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class ProjectsController extends ActiveController
{
    public $modelClass = Projects::class;

    public function checkAccess($action, $model = null, $params = [])
    {
        if ( in_array($action, ['update', 'delete']) && !\Yii::$app->user->can('admin') ) {
            /** @var $model Projects */
            if ($model->create_user_id !== \Yii::$app->user->id) {
                throw new ForbiddenHttpException();
            }
        }
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];

        return $behaviors;
    }

    public function actionAuth()
    {
        return \Yii::$app->user->identity;
    }

    public function actionDataProvider()
    {
        return new ActiveDataProvider([
                'query' => Projects::find(),
                'pagination' => [
                    'pageSizeLimit' => [ 10, 50 ],
                ],
            ]
        );
    }
}