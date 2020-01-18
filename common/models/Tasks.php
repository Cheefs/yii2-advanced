<?php

namespace common\models;

use frontend\models\ChatLog;
use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title название задачи
 * @property int|null $execute_user_id указатель на исполнителя задачи
 * @property int $is_template флаг является ли задача шаблоном
 * @property int|null $project_id указатель на проект
 * @property string $type перечисление типов задач (сделал аналогично как jira)
 * @property string $status перечисление статусов задач
 * @property int $create_user_id указатель на пользователя создашего задачу
 * @property string|null $crate_datetime
 * @property string|null $update_datetime
 * @property int $priority_id указатель на приоритет задачи
 *
 * @property ChatLog[] $chatLogs
 * @property Users $createUser
 * @property Users $executeUser
 * @property Priority $priority
 * @property Projects $project
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'create_user_id', 'priority_id'], 'required'],
            [['execute_user_id', 'is_template', 'project_id', 'create_user_id', 'priority_id'], 'integer'],
            [['type', 'status'], 'string'],
            [['crate_datetime', 'update_datetime'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['create_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['create_user_id' => 'id']],
            [['execute_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['execute_user_id' => 'id']],
            [['priority_id'], 'exist', 'skipOnError' => true, 'targetClass' => Priority::className(), 'targetAttribute' => ['priority_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'execute_user_id' => Yii::t('app', 'Execute User ID'),
            'is_template' => Yii::t('app', 'Is Template'),
            'project_id' => Yii::t('app', 'Project ID'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'create_user_id' => Yii::t('app', 'Create User ID'),
            'crate_datetime' => Yii::t('app', 'Crate Datetime'),
            'update_datetime' => Yii::t('app', 'Update Datetime'),
            'priority_id' => Yii::t('app', 'Priority ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChatLogs()
    {
        return $this->hasMany(ChatLog::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'create_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecuteUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'execute_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(Priority::className(), ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }
}
