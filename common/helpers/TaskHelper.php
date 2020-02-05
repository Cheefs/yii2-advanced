<?php

namespace common\helpers;

use common\models\Tasks;
use common\models\ChatLog;
use yii\helpers\Json;
use yii\log\Logger;

/**
 * Несовсем понятно зачем такой хелпер, только лишняя работа
 * разве что чат лог писать, или логирование какоето
*/
class TaskHelper
{
    const TASKS_KEY_FOR_USER = 'tasks-to-user_id=';
    const ACTIVE_TASKS = [Tasks::STATUS_NEW, Tasks::STATUS_ACTIVE, Tasks::STATUS_IN_WORK];
    const DEFAULT_DURATION = 3600;

    /**
     * Получение задач для пользователя, с функцией кеширования
     * @param $userId int
     * @param $showCreated bool интересуют ли в выборке и задачи где мы лиш создатель
     * @param $statuses array
     * @param $useCache bool
     * @return array Tasks[]
     **/
    public static function getTaskByUserId( int $userId, bool $showCreated = false, array $statuses = self::ACTIVE_TASKS, bool $useCache = true ): array {
        $cacheKey = self::TASKS_KEY_FOR_USER . $userId;
        $cashedTasks = $useCache ? \Yii::$app->cache->get($cacheKey) : null;

        if ( !$cashedTasks || !count( $cashedTasks )) {
            $tasks = Tasks::find()->where(['create_user_id' => $userId ]);

            if ( $showCreated ) {
                $tasks->orWhere(['execute_user_id' => $userId ]);
            }

            $tasks->andWhere([ 'in', 'status', $statuses ])
                  ->andWhere(['is_template' => false ]);
            $cashedTasks = $tasks->all();
            \Yii::$app->cache->set( $cacheKey, $cashedTasks, self::DEFAULT_DURATION );
        }

        return $cashedTasks;
    }
}