<?php

namespace frontend\models\forms;

use common\models\Tasks;
use frontend\models\TasksTemplates;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * @property  boolean $asTemplate
*/
class TaskForm extends Tasks
{
    const STATUS_NEW = 'New';

    public $asTemplate = false;
    public $type = 'Task';
    public $status = self::STATUS_NEW;

    public function rules() {
        $rules = [
            [['asTemplate'], 'boolean']
        ];
        return ArrayHelper::merge(parent::rules(), $rules);
    }

    public function attributeLabels() {
        $labels = [
            'asTemplate' => \Yii::t('app', 'Save as template')
        ];
        return ArrayHelper::merge( parent::attributeLabels(), $labels );
    }

    public function save($runValidation = true, $attributeNames = null) {
        if ( $this->asTemplate ) {
            $templatesModel = new TasksTemplates();
            $templatesModel->user_id = \Yii::$app->user->id;
            $templatesModel->params = Json::encode( $this->attributes );
            return $templatesModel->save();
        } else {
            return parent::save($runValidation, $attributeNames);
        }
    }
}