<?php

use yii\db\Migration;

/**
 * Handles the creation of table `projects`.
 */
class m200110_124622_create_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('projects', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('название проетка'),
            'parent_id' => $this->integer()->comment('указатель на родительский проект'),
            'create_user_id' => $this->integer()->notNull()->comment('указатель на пользователя создашего доску'),
            'crate_datetime' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'update_datetime' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        /** внешний ключь указывающий на создателя проекта */
        $this->addForeignKey(
            'fk-projects-create_user_id',
            'projects',
            'create_user_id',
            'users',
            'id'
        );

        /** внешний ключь указывающий на родительский проект */
        $this->addForeignKey(
            'fk-projects-parent_id',
            'projects',
            'parent_id',
            'projects',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk-projects-create_user_id', 'projects');
        $this->dropForeignKey('fk-projects-parent_id', 'projects');
        $this->dropTable('projects');
    }
}


