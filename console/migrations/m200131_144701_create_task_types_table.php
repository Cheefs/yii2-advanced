<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task_statuses`.
 */
class m200131_144701_create_task_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task_types', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Название статуса'),
            'icon'=> $this->string()->comment('Css класс иконки')
        ]);
        $this->insert('task_types', [ 'name' => 'task', 'icon' => 'glyphicon glyphicon-pushpin task' ]);
        $this->insert('task_types', [ 'name' => 'error', 'icon' => 'glyphicon glyphicon-record error' ]);
        $this->insert('task_types', [ 'name' => 'epic', 'icon' => 'glyphicon glyphicon-flash epic' ]);
        $this->insert('task_types', [ 'name' => 'subtask', 'icon' => 'glyphicon glyphicon-link subtask' ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('task_types');
    }
}
