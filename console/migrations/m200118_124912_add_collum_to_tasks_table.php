<?php

use yii\db\Migration;

/**
 * Class m200118_124912_add_collum_to_tasks_table
 */
class m200118_124912_add_collum_to_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tasks', 'priority_id', $this->integer()->notNull()->comment('указатель на приоритет задачи'));
        $this->addForeignKey(
            'fk-tasks-priority_id',
            'tasks',
            'priority_id',
            'priority',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-tasks-priority_id', 'tasks');
        $this->dropColumn('tasks', 'priority_id');
    }
}
