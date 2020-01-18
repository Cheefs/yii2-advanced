<?php

use yii\db\Migration;

/**
 * Статус задач, связь пользователя, и записи в чат log чтоб понимать видел ли он сообщение
 * Handles the creation of table `chat_log_status_to_users`.
 */
class m200114_161123_create_chat_log_status_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chat_log_status_to_users', [
            'user_id' => $this->integer()->comment('указатель на пользователя'),
            'chat_log_id' =>$this->integer()->comment('указатель на сообщение'),
            'is_viewed' => $this->boolean()->notNull()->defaultValue(false )->comment('флаг указывающий видел ли прользователь сообщение'),
        ]);
        /** Указатель на пользователя */
        $this->addForeignKey(
            'fk-chat_log_status_to_users_user_id',
            'chat_log_status_to_users',
            'user_id',
            'users',
            'id'
        );
        /** Указатель на сообешение */
        $this->addForeignKey(
            'fk-chat_log_status_to_users-chat_log_id',
            'chat_log_status_to_users',
            'chat_log_id',
            'chat_log',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-chat_log_status_to_users_user_id', 'chat_log_status_to_users');
        $this->dropForeignKey('fk-chat_log_status_to_users-chat_log_id', 'chat_log_status_to_users');
        $this->dropTable('chat_log_status_to_users' );
    }
}
