<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
/* @var $boardsList array Boards */
/* @var $users array User */

?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'execute_user_id')->dropDownList($users)->label( Yii::t('app', 'Executor')) ?>

    <?= $form->field($model, 'board_id')->dropDownList($boardsList)->label( Yii::t('app', 'Board')) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'task' => 'Task', 'error' => 'Error', 'epic' => 'Epic', 'subtask' => 'Subtask', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'new' => 'New', 'active' => 'Active', 'in_work' => 'In work', 'canceled' => 'Canceled', 'completed' => 'Completed', ], ['prompt' => '']) ?>

    <?php if ( !$model->id ): ?>
       <?= $form->field($model, 'asTemplate')->checkbox() ?>
    <?php endif; ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
