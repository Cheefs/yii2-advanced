<?php
namespace frontend\models;

use common\models\Projects;
use common\models\Tasks;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "chat_log".
 *
 * @property int $id [int(11)]
 * @property string $username [varchar(255)]  имя пользователя
 * @property int $user_id [int(11)]  указатель на пользователя
 * @property int $created_at [bigint(20)]  дата создания сообщения
 * @property int $updated_at [bigint(20)]  дата изменения сообщения
 * @property int $task_id [int(11)]  указатель на задачу
 * @property string $message текст сообщения
 *
 * @property Tasks $task
 * @property Projects $project
 *
 */
class ChatLog extends \yii\db\ActiveRecord
{

    const SHOW_HISTORY = 1;
    const SEND_MESSAGE = 2;

    public $type = self::SHOW_HISTORY;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat_log';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'project_id', 'task_id'], 'integer'],
            [['username', 'type'], 'required'],
            [['message'], 'string'],
            [['username'], 'string', 'max' => 255],
        ];
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::class => ['class' => TimestampBehavior::class],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'message' => 'Message',
            'task_id' => 'Task Id',
            'project_id' => 'Project Id'
        ];
    }
    /**
     * @param array $data
     * @return bool
     */
    public static function create(array $data)
    {
        try {
            $model = new self($data);
            return $model->save();
        } catch (\Throwable $throwable) {
            Yii::error($throwable->getTraceAsString());
            Yii::error(json_encode($data));
        }
        return false;
    }

    public function getTask()
    {
        return $this->hasOne(Tasks::class, ['id' => 'task_id']);
    }

    public function getProject()
    {
        return $this->hasOne(Tasks::class, ['id' => 'project_id']);
    }
}