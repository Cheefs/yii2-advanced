<?php

namespace console\components;

use frontend\models\ChatLog;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use yii\helpers\Json;

class SocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }
    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $this->sendHelloMessage($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }
    /**
     * @param ConnectionInterface $from
     * @param string $msg
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {
        $msgArray = json_decode($msg, true);

        if ( $msgArray['type'] === ChatLog::SEND_MESSAGE) {
            ChatLog::create($msgArray);

            foreach ($this->clients as $client) {
                $client->send($msg);
            }
        } else {
            $this->showHistory($from, $msgArray);
        }
    }
    private function showHistory(ConnectionInterface $conn, $msg = null )
    {
        $chatLogsQuery = ChatLog::find()
            ->where(['task_id' => $msg['taskId'] ])
            ->orderBy('created_at ASC');
        foreach ($chatLogsQuery->each() as $chatLog) {
            /**
             * @var ChatLog $chatLog
             */
            $this->sendMessage( $conn, ['message' => $chatLog->message, 'username' => $chatLog->username]);
        }
    }
    /**
     * @param ConnectionInterface $conn
     * @param array $msg
     */
    private function sendMessage(ConnectionInterface $conn, array $msg)
    {
        $conn->send(json_encode($msg));
    }
    /**
     * @param ConnectionInterface $conn
     */
    private function sendHelloMessage(ConnectionInterface $conn)
    {
        $this->sendMessage($conn,['message' => 'Всем привет', 'username' => 'Чат студентов geekbrains.ru']);
    }
    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
