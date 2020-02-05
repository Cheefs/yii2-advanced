<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TaskTypes */

$this->title = Yii::t('app', 'Create Task Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Task Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
