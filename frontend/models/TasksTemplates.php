<?php

namespace frontend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "tasks_templates".
 *
 * @property int $id
 * @property int $user_id пользователь который себе создал Шаблон
 * @property string|null $params поле параметров шаблона формат json
 * @property string $create_date
 *
 * @property User $user
 */
class TasksTemplates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks_templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['create_date'], 'safe'],
            [['params'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'params' => Yii::t('app', 'Params'),
            'create_date' => Yii::t('app', 'Create Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
