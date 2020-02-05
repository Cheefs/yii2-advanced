<?php

use yii\db\Migration;

/**
 * Handles the creation of table `priority`.
 */
class m200118_124309_create_priority_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('priority', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->comment('Название приоритета'),
            'order' => $this->string()->comment('Порядок выполнения(вес)'),
            'type' => $this->tinyInteger()->comment('К какой сущьности относится приоритет 1 - задача, 0 - проект')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('priority');
    }
}