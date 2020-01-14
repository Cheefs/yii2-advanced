<?php ?>
    <div class="chat__window">
        <div id="chat" style="min-height: 100px; border-color: #1c7430; border: 2px;"></div>
        <div id="response" style="color:#D00"></div>
    </div>

    <div class="row">
        <div class="col-lg-9">
            <?= \yii\helpers\Html::textInput('message', '', ['id' => 'message-input', 'class' => 'form-control'])?>
        </div>

        <div class="col-lg-3">
            <?= \yii\helpers\Html::button('Отправить', ['id' => 'btn-send-message', 'class' => 'btn btn-primary'])?>
        </div>
    </div>

<?php if (Yii::$app->user->isGuest) {
    echo \yii\helpers\Html::hiddenInput('username', $username, ['class' => 'username']);
} ?>
