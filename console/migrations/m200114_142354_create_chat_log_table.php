<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chat_log`.
 */
class m200114_142354_create_chat_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chat_log', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->comment('имя пользователя'),
            'user_id' => $this->integer()->comment('указатель на пользователя'),
            'created_at' => $this->bigInteger()->comment('дата создания сообщения'),
            'updated_at' => $this->bigInteger()->comment('дата изменения сообщения'),
            'task_id' => $this->integer()->comment('указатель на задачу'),
            'message' => $this->text()->comment('текст сообщения'),
        ]);

        /** внешний ключь указывающий на задачу */
        $this->addForeignKey(
            'fk-chat_log-task_id',
            'chat_log',
            'task_id',
            'tasks',
            'id'
        );

        /** внешний ключь указывающий на пользователя создавшего сообщение */
        $this->addForeignKey(
            'fk-chat_log-user_id',
            'chat_log',
            'user_id',
            'users',
            'id'
        );
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-chat_log-task_id', 'chat_log');
        $this->dropForeignKey('fk-chat_log-user_id', 'chat_log');
        $this->dropTable('chat_log');
    }
}