<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title название задачи
 * @property int|null $execute_user_id указатель на исполнителя задачи
 * @property int|null $board_id указатель на доску
 * @property string $type перечисление типов задач (сделал аналогично как jira)
 * @property string $status перечисление статусов задач
 * @property int $create_user_id указатель на пользователя создашего задачу
 * @property string|null $crate_datetime
 * @property string|null $update_datetime
 *
 * @property Boards $board
 * @property Users $createUser
 * @property Users $executeUser
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
            [['title', 'create_user_id'], 'required'],
            [['execute_user_id', 'board_id', 'create_user_id'], 'integer'],
            [['type', 'status'], 'string'],
            [['crate_datetime', 'update_datetime'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['board_id'], 'exist', 'skipOnError' => true, 'targetClass' => Boards::class, 'targetAttribute' => ['board_id' => 'id']],
            [['create_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['create_user_id' => 'id']],
            [['execute_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['execute_user_id' => 'id']],
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
            'board_id' => Yii::t('app', 'Board ID'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'create_user_id' => Yii::t('app', 'Create User ID'),
            'crate_datetime' => Yii::t('app', 'Crate Datetime'),
            'update_datetime' => Yii::t('app', 'Update Datetime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoard()
    {
        return $this->hasOne(Boards::class, ['id' => 'board_id']);
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
}
