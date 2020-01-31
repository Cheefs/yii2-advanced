<?php

namespace common\helpers;

use common\models\Tasks;
use frontend\models\ChatLog;

class ChatLogHelper
{
    const CHAT_LOG_KEY_FOR_USER = 'chat-log-to-user_id=';
    const DEFAULT_DURATION = 300;

    /**
     * Получение последних активностей для пользователя, с функцией кеширования
     * @param $userId int
     * @param $useCache bool
     * @return array ChatLog[]
     **/
    public static function getLastActivityByUserTasks( int $userId, bool $useCache = true ): array {
        $cacheKey = self::CHAT_LOG_KEY_FOR_USER . $userId;
        $cashedMessages = $useCache ? \Yii::$app->cache->get($cacheKey) : null;

        if ( !$cashedMessages || !count( $cashedMessages )) {
            $messages = ChatLog::find()
                ->alias('c')
                ->innerJoin(Tasks::tableName().' t','t.id = c.task_id')
                ->where(['c.user_id' => $userId ])
                ->orWhere(['t.create_user_id' => $userId ])
                ->orWhere([ 't.execute_user_id' => $userId ])
                ->all();
            \Yii::$app->cache->set($cacheKey, $messages, self::DEFAULT_DURATION);
            $cashedMessages = $messages;
        }
        return $cashedMessages;
    }
}