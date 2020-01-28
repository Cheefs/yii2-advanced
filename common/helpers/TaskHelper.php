<?php

namespace common\helpers;

use common\models\Tasks;
use frontend\models\ChatLog;
use yii\helpers\Json;
use yii\log\Logger;

/**
 * Несовсем понятно зачем такой хелпер, только лишняя работа
 * разве что чат лог писать, или логирование какоето
*/
class TaskHelper
{
    /**
     * @param $model Tasks
     * @return bool
     */
    public static function createTask( $model ) {
        $saved = false;
        try {
            $saved = $model->save();
            if (!$saved) {
                throw new \Exception($model);
            }

            ChatLog::create([
                'username' => \Yii::$app->user->identity->username,
                'message' => 'Task Created',
                'task_id' => $model->id,
                'project_id' => $model->project_id
            ]);

        } catch ( \Exception $ex ) {
            $date = date('Y-M-D');
            (new Logger())->log(Json::encode([
                "[task_create][$date]" => $ex->getMessage()
            ]), 'error');
        }

        return $saved;
    }
}