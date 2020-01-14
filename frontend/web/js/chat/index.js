const SHOW_HISTORY = 1;
const SEND_MESSAGE = 2;
const chat = new WebSocket('ws://localhost:8080');
const username = document.querySelector('.username').value;
const $messageInput = document.querySelector('#message-input');

if ( !username ) {
   $btnSend = document.querySelector('#btn-send-message');
   $chatWindow = document.querySelector('.chat__window .chat__body');
   $chatWindow.innerHTML = 'You Must Login First';
   $chatWindow.classList.add('bg_muted');

   [ $btnSend, $messageInput ].forEach( el => el.disabled = true );
}

chat.onmessage = function (e) {
    $('#response').text('');
    console.log(e);
    let response = JSON.parse(e.data);
    $chatItem = document.createElement('div');
    $('#chat').append(`<div><b>${ response.username }</b>:&nbsp;${  response.message }</div>`);
    $('#chat').scrollTop = $('#chat').height;
};

chat.onopen = function (e) {
    console.log("Connection established!");
    chat.send(JSON.stringify({
            'username': username,
             'type': SHOW_HISTORY,
        })
    );
};


$('#btn-send-message').click(function () {
    if ( username ) {
        chat.send(JSON.stringify({
                'username': username,
                'message': $messageInput ? $messageInput.value : null,
                'type': SEND_MESSAGE,
            })
        );
        $messageInput.value = null;
    }
});