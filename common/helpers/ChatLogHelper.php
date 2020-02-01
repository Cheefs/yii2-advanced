<?php

namespace common\helpers;

use frontend\models\ChatLog;

class ChatLogHelper
{
    const CHAT_LOG_KEY_FOR_USER = 'chat-log-to-user_id=';
    const DEFAULT_DURATION = 100;

    /**
     * Получение последних активностей для пользователя, с функцией кеширования
     * @param $userId int
     * @param $tasksList array
     * @param $useCache bool
     * @return array ChatLog[]
     **/
    public static function getLastActivityByUserTasks( int $userId, array $tasksList, bool $useCache = true ): array {
        $cacheKey = self::CHAT_LOG_KEY_FOR_USER . $userId;
        $cashedMessages = $useCache ? \Yii::$app->cache->get($cacheKey) : null;

        if ( !$cashedMessages || !count( $cashedMessages )) {
            $tasksIds = array_map( function($task) {
                return $task->id;
            }, $tasksList );
            $messages = ChatLog::find()
                ->where(['IN', 'task_id',  $tasksIds])
                ->all();
            \Yii::$app->cache->set($cacheKey, $messages, self::DEFAULT_DURATION);
            $cashedMessages = $messages;
        }
        return $cashedMessages;
    }
}