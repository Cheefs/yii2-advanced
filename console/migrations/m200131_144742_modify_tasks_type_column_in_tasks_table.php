<?php

use yii\db\Migration;

/**
 * Class m200131_144742_modify_tasks_type_column_in_tasks_table
 */
class m200131_144742_modify_tasks_type_column_in_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tasks', 'type', $this->integer());
        $this->renameColumn('tasks', 'type', 'type_id');
        $this->addForeignKey(
            'fk-tasks-type_id',
            'tasks',
            'type_id',
            'task_types',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-tasks-type_id', 'tasks');
        $this->alterColumn('tasks', 'type_id',  "ENUM('task', 'error', 'epic', 'subtask')");
        $this->renameColumn('tasks', 'type_id', 'type');
    }
}
