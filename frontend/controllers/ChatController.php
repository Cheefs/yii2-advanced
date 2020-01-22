<?php

namespace frontend\controllers;

class ChatController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}