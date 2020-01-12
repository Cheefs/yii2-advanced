<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Boards */

$this->title = Yii::t('app', 'Create Board Form');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Boards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boards-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
