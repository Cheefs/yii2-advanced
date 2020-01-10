<?php

namespace console\controllers;

use yii\console\Controller;

/**
 * одно только непонятно, зачем в методичке пишут что надо вызывать команду вот так: consoleGreetings
 *
 * На первом курсе мы проходили что вызывается через дефис, и сам терминал говорит что неверная команда и
 * попробуйте console-greetings
 */

class ConsoleGreetingsController extends Controller {

    public function actionIndex() {
        echo PHP_EOL.'Hello World'.PHP_EOL;
    }
}
