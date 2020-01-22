<?php

namespace frontend\widgets\chat;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class ChatAsset extends AssetBundle
{
    public $sourcePath = (__DIR__ . '/assets');

    public $css = [
        'css/main.css',
    ];
    public $js = [
        'js/index.js'
    ];

    public $depends = [
        YiiAsset::class
    ];
}
