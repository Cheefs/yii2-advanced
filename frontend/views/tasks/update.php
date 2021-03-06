<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $projectsList common\models\Projects[]  */
/* @var $usersList common\models\User[] */
/* @var $priorityList common\models\Priority[] */
/* @var $templatesList common\models\Tasks[] */
/* @var $typesList \common\models\TaskTypes[] */

$this->title = Yii::t('app', 'Update Tasks: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => Url::to(['tasks/index'])];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' =>  Url::to(['view', 'id' => $model->id])];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tasks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'projectsList' => $projectsList,
        'usersList' => $usersList,
        'priorityList' => $priorityList,
        'templatesList' => $templatesList,
        'typesList' => $typesList
    ]) ?>

</div>
