<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

/* @var $tasksSearchModel common\models\search\TaskSearch */
/* @var $tasksDataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' =>  Url::to(['index'])];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);



?>
<div class="projects-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'),  Url::to(['update', 'id' => $model->id]), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'),  Url::to(['delete', 'id' => $model->id]), [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'format' => 'raw',
                'attribute' => 'name',
                'value' => function($model) {
                    /** @var $model common\models\Projects */
                    return Html::a($model->name,  Url::to(['projects/view', 'id' => $model->id ]) );
                }
            ],
            [
                'label' => Yii::t('app', 'parent project'),
                'format' => 'raw',
                'attribute' => 'parent_id',
                'value' => function($model) {
                    /** @var $model common\models\Projects */
                    $parent = $model->parent ?? null;
                    return  $parent ? Html::a( $parent->name,  Url::to(['projects/view', 'id' => $parent->id ]) ) : null;
                }
            ],
            [
                'label' => Yii::t('app', 'creator'),
                'attribute' => 'create_user_id',
                'value' => function($model) {
                    /** @var $model common\models\Projects */
                    return $model->createUser->username;
                }
            ],
            [
                'format' => 'raw',
                'attribute' => 'created_at',
                'value' => function($model) {
                    /** @var $model common\models\Projects */
                    return Yii::$app->formatter->asDatetime( $model->created_at );
                }
            ],
        ],
    ]) ?>

    <h3 class="text-center"><?= Yii::t('app', 'tasks in project') ?></h3>
    <?= GridView::widget([
        'dataProvider' => $tasksDataProvider,
        'summary' => false,
        'columns' => [
            [
                'label' => 'T',
                'attribute' => 'type_id',
                'format' => 'raw',
                'value' => function($model) {
                    /** @var $model \common\models\Tasks */
                    return Html::tag('i', '', [
                        'class' => $model->type->icon
                    ]);
                },
            ],
            [
                'format' => 'raw',
                'attribute' => 'title',
                'value' => function($model) {
                    /** @var $model common\models\Tasks */
                    return Html::a($model->title,  Url::to(['tasks/view', 'id' => $model->id ]));
                }
            ],
            [
                'label' => Yii::t('app', 'executor'),
                'attribute' => 'execute_user_id',
                'value' => function($model) {
                    /** @var $model common\models\Tasks */
                    return $model->executeUser->username;
                }
            ],

            'status',
            [
                'label' => Yii::t('app', 'creator'),
                'attribute' => 'create_user_id',
                'value' => function($model) {
                    /** @var $model common\models\Tasks */
                    return $model->createUser->username;
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function($model) {
                    /** @var $model common\models\Tasks */
                    return Yii::$app->formatter->asDatetime( $model->created_at );
                }
            ],
            [
                'label' => Yii::t('app', 'priority'),
                'attribute' => 'priority_id',
                'value' => function($model) {
                    /** @var $model common\models\Tasks */
                    return $model->priority->title;
                }
            ],
        ],
    ]); ?>

</div>
