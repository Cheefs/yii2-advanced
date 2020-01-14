<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'execute_user_id')->textInput() ?>

    <?= $form->field($model, 'board_id')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList([ 'task' => 'Task', 'error' => 'Error', 'epic' => 'Epic', 'subtask' => 'Subtask', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'new' => 'New', 'active' => 'Active', 'in_work' => 'In work', 'canceled' => 'Canceled', 'completed' => 'Completed', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'create_user_id')->textInput() ?>

    <?= $form->field($model, 'crate_datetime')->textInput() ?>

    <?= $form->field($model, 'update_datetime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
