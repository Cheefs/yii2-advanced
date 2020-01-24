/** Код написан на синтаксисе ES6++ не использую jquery */
const SHOW_HISTORY = 1;
const SEND_MESSAGE = 2;
const KEY_CODE_ENTER = 13;
const chat = new WebSocket('ws://localhost:8080');
const $chatNode = document.querySelector('#js-messages-content');
const $messageInput = document.querySelector('#message-input');
const $chatWindowNode = document.querySelector('.chat__window');

const getMetaNode = ( name ) => document.querySelector(`[name=${ name }]`) || {};

const username = getMetaNode('chat-widget-username').content;
const taskId = getMetaNode('chat-widget-task-id').content;
const projectId = getMetaNode('chat-widget-project-id').content;

/** скроллинг окна чата */
const scrollChatToBottom = () => document.querySelector('.chat__body').scrollTop = $chatNode.offsetTop;

/** функция отправки сообщений */
const senMessage = () => {
    const message = $messageInput ? $messageInput.value : null;
    if ( !( username && message ) ) return;

    chat.send( JSON.stringify({
        task_id: taskId,
        type: SEND_MESSAGE,
        project_id: projectId,
        username,
        message,
    }));

    $messageInput.value = null;
    scrollChatToBottom();
};

if ( $chatNode )  {
    if ( !username ) {
        $btnSend = document.querySelector('#btn-send-message');
        $chatBody = document.querySelector('.chat__window .chat__body');
        $chatBody.innerHTML = 'You Must Login First';
        $chatBody.classList.add('bg_muted');

        [ $btnSend, $messageInput ].forEach( el => el.disabled = true );
    }

    chat.onopen = (event) => {
        console.log("Connection established!");
        chat.send( JSON.stringify({ task_id: taskId, project_id: projectId, username, 'type': SHOW_HISTORY } ) );
    };

    chat.onmessage = ({ data }) => {
        const { username: authorUserName, message } = JSON.parse( data );
        const $chatItem = document.createElement('div');

        let className = authorUserName === username ? 'text_left' :'text_right';
        let author = authorUserName ? `${ authorUserName }:` : '';

        /** если автор неуказан, то это системное сообщение */
        if ( !authorUserName ) {
            className = 'text_center color_red';
        }

        $messageInput.textContent = '';
        $chatItem.innerHTML = `<div class="${ className }"><b>${ author }</b>&nbsp;${ message }</div>`;
        $chatNode.appendChild( $chatItem );
        $chatNode.scrollBottom =  $chatNode.offsetHeight;
    };
    
    /** события нажатия на ENTER для удобства
     * Нижеследующий код отправляет сообщение только когда переменная\условие перед вызовом функции === true
     * ( т.е. выполняется блок после логического И только в этом случае, это специфика js костыля тут нет, как может показатся....  )
     **/
    document.addEventListener('keypress', ({ keyCode }) => (keyCode === KEY_CODE_ENTER) && senMessage());
}

document.addEventListener('click', (event) => {
    const { target } = event;
    const btnHide = document.querySelector('.js-hide');
    const btnShow = document.querySelector('.js-show');

    if ( $chatWindowNode &&  ( target === btnHide || target === btnShow ) ) {
        if ( target === btnHide) {
            $chatWindowNode.classList.add('hide');
            btnHide && btnHide.classList.add('hide');
            btnShow && btnShow.classList.remove('hide');
        } else {
            $chatWindowNode.classList.remove('hide');
            btnHide && btnHide.classList.remove('hide');
            btnShow && btnShow.classList.add('hide');
        }

    } else if ( target.classList.contains('btn-send-message')) {
        senMessage();
    }
});
