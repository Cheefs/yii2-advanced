<div class="chat-popup form-container chat__container">

    <div class="chat__window js-chat-content">
        <h2><?= Yii::t('app', 'chat') ?></h2>
         <div id="js-messages-content" class="chat__body"></div>


        <label for="message-input"><b>Message</b></label>
        <textarea id="message-input" placeholder="Type message.." name="msg" required></textarea>


        <button type="button" class="btn btn-send-message">Send</button>
        <button type="button" class="btn cancel js-hide">Hide</button>
    </div>

    <button type="button" class="btn btn-primary js-show hide">Show</button>
</div>