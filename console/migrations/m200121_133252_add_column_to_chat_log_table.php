<?php

use yii\db\Migration;

/**
 * Class m200121_133252_add_column_to_chat_log_table
 */
class m200121_133252_add_column_to_chat_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'chat_log',
            'project_id',
            $this->integer()->notNull()->comment('указатель на проект')
        );

        $this->addForeignKey(
            'fk-chat_log_project_id',
            'chat_log',
            'task_id',
            'projects',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-chat_log_project_id', 'chat_log');
        $this->dropColumn('chat_log', 'project_id');
    }

}