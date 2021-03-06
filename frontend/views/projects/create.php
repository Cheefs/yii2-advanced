<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */
/* @var $projectsList common\models\Projects[]  */

$this->title = Yii::t('app', 'Create Projects');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => Url::to(['index'])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'projectsList' => $projectsList,
    ]) ?>

</div>
