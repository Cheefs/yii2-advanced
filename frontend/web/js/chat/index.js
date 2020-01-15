/** Код написан на синтаксисе ES6++ не использую jquery */
const SHOW_HISTORY = 1;
const SEND_MESSAGE = 2;
const KEY_CODE_ENTER = 13;
const chat = new WebSocket('ws://localhost:8080');
const $responseNode = document.querySelector('#response');
const $chatNode = document.querySelector('#chat');
const $currentUserDomNode = document.querySelector('.username');
const $currentTaskDomNode = document.querySelector('.task_id');
const $messageInput = document.querySelector('#message-input');
const $sendMessageButton = document.querySelector('#btn-send-message');

const currentUser = $currentUserDomNode ? $currentUserDomNode.value : null;
const taskId = $currentTaskDomNode ? $currentTaskDomNode.value : null;

/** скроллинг окна чата */
const scrollChatToBottom = () => document.querySelector('.chat__body').scrollTop = $chatNode.offsetTop;

if ( !currentUser ) {
   $btnSend = document.querySelector('#btn-send-message');
   $chatWindow = document.querySelector('.chat__window .chat__body');
   $chatWindow.innerHTML = 'You Must Login First';
   $chatWindow.classList.add('bg_muted');

   [ $btnSend, $messageInput ].forEach( el => el.disabled = true );
}

chat.onopen = (event) => {
    console.log("Connection established!");
    chat.send( JSON.stringify({ taskId, 'username': currentUser, 'type': SHOW_HISTORY } ) );
};

chat.onmessage = ({ data }) => {
    const { username, message } = JSON.parse( data );
    const className = username === currentUser ? 'text_left' :'text_right';
    const $chatItem = document.createElement('div');

    $responseNode.textContent = '';
    $chatItem.innerHTML = `<div class="${ className }"><b>${ username }</b>:&nbsp;${ message }</div>`;
    $chatNode.appendChild( $chatItem );
    $chatNode.scrollBottom =  $chatNode.offsetHeight;

    scrollChatToBottom();
};

/** функция отправки сообщений */
const senMessage = () => {
    const message = $messageInput ? $messageInput.value : null;
    if ( !( currentUser && message ) ) return;
    chat.send(JSON.stringify({ username: currentUser, message, type: SEND_MESSAGE }) );
    $messageInput.value = null;
    scrollChatToBottom();
};

/** события нажатия на ENTER для удобства
 * Нижеследующий код отправляет сообщение только когда переменная\условие перед вызовом функции === true
 * ( т.е. выполняется блок после логического И только в этом случае, это специфика js костыля тут нет, как может показатся....  )
 **/
document.addEventListener('keypress', ({ keyCode }) => (keyCode === KEY_CODE_ENTER) && senMessage());
/** добавление события нажатия на кнопку отправки сообщения, предварительно убедившись что эта кнопка была найдена */
$sendMessageButton && $sendMessageButton.addEventListener('click', senMessage );