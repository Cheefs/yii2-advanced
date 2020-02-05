<?php

namespace backend\models;

use common\models\Tasks;
use Yii;

/**
 * This is the model class for table "task_types".
 *
 * @property int $id
 * @property string|null $name Название статуса
 * @property string|null $icon Css класс иконки
 *
 * @property Tasks[] $tasks
 */
class TaskTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'icon' => Yii::t('app', 'Icon'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['type_id' => 'id']);
    }
}
