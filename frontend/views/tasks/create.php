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

$this->title = Yii::t('app', 'Create Tasks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => Url::to(['tasks/index'])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

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
