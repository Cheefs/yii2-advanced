<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
/* @var $projectsList common\models\Projects[]  */
/* @var $usersList common\models\User[] */
/* @var $prioritysList common\models\User[] */

?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'execute_user_id')->dropDownList( $usersList ?? [] )->label('executor') ?>

    <?= $form->field($model, 'is_template')->checkbox()->label( Yii::t('app', 'is template') .'?' ) ?>

    <?= $form->field($model, 'project_id')->dropDownList( $projectsList ?? [] )->label('project') ?>

    <?= $form->field($model, 'type')->dropDownList([
            'task' => 'Task', 'error' => 'Error', 'epic' => 'Epic', 'subtask' => 'Subtask'
    ], ['prompt' => 'Task']) ?>

    <?= $form->field($model, 'priority_id')->dropDownList( $prioritysList ?? [] )->label('priority') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
