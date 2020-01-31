<?php

namespace common\models;

use frontend\models\ChatLog;
use Yii;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

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
 * @property integer $created_at
 * @property integer $updated_at
 * @property int $priority_id указатель на приоритет задачи
 *
 * @property ChatLog[] $chatLogs
 * @property Users $createUser
 * @property Users $executeUser
 * @property Priority $priority
 * @property array $links
 * @property Projects $project
 */
class Tasks extends \yii\db\ActiveRecord implements Linkable
{
    const STATUS_NEW = 'new';
    const STATUS_ACTIVE = 'active';
    const STATUS_IN_WORK = 'in_work';
    const STATUS_CANCELED = 'canceled';
    const STATUS_COMPLETE = 'complete';

    const HISTORY_KEY = 'tasks';
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
            [['title', 'priority_id' ], 'required'],
            [['execute_user_id', 'is_template', 'project_id', 'create_user_id', 'priority_id', 'created_at', 'updated_at'], 'integer'],
            [['type', 'status'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['create_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['create_user_id' => 'id']],
            [['execute_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['execute_user_id' => 'id']],
            [['priority_id'], 'exist', 'skipOnError' => true, 'targetClass' => Priority::class, 'targetAttribute' => ['priority_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::class, 'targetAttribute' => ['project_id' => 'id']],
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
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'priority_id' => Yii::t('app', 'Priority ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChatLogs()
    {
        return $this->hasMany(ChatLog::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUser()
    {
        return $this->hasOne(Users::class, ['id' => 'create_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecuteUser()
    {
        return $this->hasOne(Users::class, ['id' => 'execute_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(Priority::class, ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::class, ['id' => 'project_id']);
    }

    public function fields()
    {
        return array_merge(parent::fields(), [
            'createUser',
            'project'
        ]);
    }

    public function extraFields()
    {
        return [
            'author',
            'authorEmail' => function () {
                return $this->createUser->email;
            },
        ];
    }

    public function getLinks()
    {
        $links = [
            Link::REL_SELF => Url::to(['tasks/view', 'id' => $this->id]),
            'createUser' => Url::to(['user/view', 'id' => $this->create_user_id])
        ];

        if ( $this->project_id ) {
            $links['project'] =  Url::to(['projects/view', 'id' => $this->project_id]);
        }

        return $links;
    }
}
