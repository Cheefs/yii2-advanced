<?php
/** @var $activityList \common\models\ChatLog[] */

use common\models\User;

?>

<div class="panel panel-success">
    <div class="panel-heading">Last Activity</div>
    <div class="panel-body page_main">
        <?php foreach ($activityList as $message): ?>
            <?php $isSystem = !$message->username || $message->username === User::SYSTEM ?>
            <div class="message <?= $isSystem ? 'danger' : 'default' ?>">
                <div class="message_user">
                    <div><?= $isSystem ? 'system' : $message->username ?></div>
                    <div></div>
                </div>
                <div class="text__block">
                    <div class="message_text"><?= $message->message ?></div>
                    <div class="message_date"><?= Yii::$app->formatter->asDatetime($message->created_at ) ?></div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>