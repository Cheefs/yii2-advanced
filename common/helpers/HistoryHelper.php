<?php

namespace common\helpers;

/**
 * Обертка для работы с сессиями ( на данный момент не придумал что тут еще реализовывать )
*/
class HistoryHelper
{
    public static function saveHistory($key, $value) {
        \Yii::$app->session->set($key,  $value);
    }

    public static function getHistory($key) {
       return \Yii::$app->session->get($key);
    }

    public static function clearHistory($key) {
        \Yii::$app->session->remove($key);
    }
}