<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m200110_130713_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('название задачи'),
            'execute_user_id' => $this->integer()->comment('указатель на исполнителя задачи'),
            'is_template' => $this->boolean()->notNull()->defaultValue( false )->comment('флаг является ли задача шаблоном'),
            'project_id' => $this->integer()->comment('указатель на проект'),
            'type' => "ENUM('task', 'error', 'epic', 'subtask') 
                comment 'перечисление типов задач (сделал аналогично как jira)' not null default 'task'
            ",
            'status' => "ENUM('new', 'active', 'in_work', 'canceled', 'completed') 
                comment 'перечисление статусов задач' not null default 'new'
            ",
            'create_user_id' => $this->integer()->comment('указатель на пользователя создашего задачу'),
            'created_at' => $this->bigInteger()->comment('дата создания сообщения'),
            'updated_at' => $this->bigInteger()->comment('дата изменения сообщения'),
        ]);
        /** внешний ключь указывающий на испонителя задачи */
        $this->addForeignKey(
            'fk-tasks-execute_user_id',
            'tasks',
            'execute_user_id',
            'users',
            'id'
        );
        /** внешний ключь указывающий на доску */
        $this->addForeignKey(
            'fk-tasks-project_id',
            'tasks',
            'project_id',
            'projects',
            'id'
        );
        /** внешний ключь указывающий на создателя задачи */
        $this->addForeignKey(
            'fk-tasks-create_user_id',
            'tasks',
            'create_user_id',
            'users',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk-tasks-execute_user_id', 'tasks');
        $this->dropForeignKey('fk-tasks-project_id', 'tasks');
        $this->dropForeignKey('fk-tasks-create_user_id', 'tasks');
        $this->dropTable('tasks');
    }
}
