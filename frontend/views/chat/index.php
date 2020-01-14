<?php /** @var $user Users  */ ?>
<div class="container chat__container">
    <div class="chat__window panel panel-default">
        <div class="panel-heading"><?= Yii::t('app', 'chat') ?></div>
        <div class="panel-body chat__body">
             <div id="chat" style="min-height: 100px; border-color: #1c7430; border: 2px;"></div>
             <div id="response" style="color:#D00"></div>
        </div>
         <div class="panel-footer">
            <div class="row">
                 <div class="col-lg-9">
                     <?= \yii\helpers\Html::textInput('message', '', ['id' => 'message-input', 'class' => 'form-control'])?>
                 </div>

                 <div class="col-lg-3">
                     <?= \yii\helpers\Html::button('Отправить', ['id' => 'btn-send-message', 'class' => 'btn btn-primary'])?>
                 </div>
             </div>
         </div>
    </div>

    <?php if ( $user ) {
        echo \yii\helpers\Html::hiddenInput('username', $user->username, ['class' => 'username']);
    } ?>
</div>