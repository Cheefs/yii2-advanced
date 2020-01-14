<?php

use yii\db\Migration;

/**
 * Handles the creation of table `boards`.
 */
class m200110_124622_create_boards_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('boards', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('название доски для задач ( как название проектов в jira )'),
            'create_user_id' => $this->integer()->notNull()->comment('указатель на пользователя создашего доску'),
            'crate_datetime' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'update_datetime' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        /** внешний ключь указывающий на создателя доски */
        $this->addForeignKey(
            'fk-boards-create_user_id',
            'boards',
            'create_user_id',
            'users',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk-boards-create_user_id', 'boards');
        $this->dropTable('boards');
    }
}


