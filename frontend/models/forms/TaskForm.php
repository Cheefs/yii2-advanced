<?php

namespace frontend\models\forms;

use common\models\Tasks;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class TaskForm extends Tasks
{
    const STATUS_NEW = 'New';

    public function behaviors()
    {
        /** поведение для установки даты создания, и даты редактирование текущей датой */
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => time()
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'create_user_id',
                ],
                'value' => \Yii::$app->user->id
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'status',
                ],
                'value' => self::STATUS_NEW
            ],
        ];
    }
}