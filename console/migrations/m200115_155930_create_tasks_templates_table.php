<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks_templates`.
 */
class m200115_155930_create_tasks_templates_table extends Migration
{
    private $tableName = 'tasks_templates';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable( $this->tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('пользователь который себе создал Шаблон'),
            'params' => $this->string()->comment('поле параметров шаблона формат json'),
            'create_date' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        /** Указатель на пользователя */
        $this->addForeignKey(
            "fk-{$this->tableName}-user_id",
            $this->tableName,
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
        $this->dropForeignKey('fk-tasks_templates-user_id', $this->tableName);
        $this->dropTable( $this->tableName );
    }
}
