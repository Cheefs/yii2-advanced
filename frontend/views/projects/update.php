<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */
/* @var $projectsList common\models\Projects[]  */

$this->title = Yii::t('app', 'Update Projects: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' =>  Url::to(['index'])];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' =>  Url::to(['view', 'id' => $model->id])];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="projects-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'projectsList' => $projectsList,
    ]) ?>

</div>
