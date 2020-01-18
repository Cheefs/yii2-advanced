<?php

namespace frontend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "chat_log_status_to_users".
 *
 * @property int|null $user_id указатель на пользователя
 * @property int|null $chat_log_id указатель на сообщение
 * @property int $is_viewed флаг указывающий видел ли прользователь сообщение
 *
 * @property ChatLog $chatLog
 * @property User $user
 */
class ChatLogStatusToUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat_log_status_to_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'chat_log_id', 'is_viewed'], 'integer'],
            [['chat_log_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChatLog::class, 'targetAttribute' => ['chat_log_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'chat_log_id' => Yii::t('app', 'Chat Log ID'),
            'is_viewed' => Yii::t('app', 'Is Viewed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChatLog()
    {
        return $this->hasOne(ChatLog::class, ['id' => 'chat_log_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
