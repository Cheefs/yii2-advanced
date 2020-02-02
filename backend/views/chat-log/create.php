<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ChatLog */

$this->title = Yii::t('app', 'Create Chat Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chat Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
