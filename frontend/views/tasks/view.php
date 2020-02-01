<?php

use common\models\Tasks;
use frontend\widgets\chat\Chat;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $user common\models\User */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => Url::to(['index'])];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$title = $model->is_template ? Yii::t('app', 'template task') : $this->title;

$canEditOrDelete = Yii::$app->user->can('admin') || Yii::$app->user->id === $model->create_user_id ;

?>
<div class="tasks-view">

    <h2 class="text-center">
        <strong><?= Html::encode( $title ) ?></strong>&nbsp;
        <span class="task_status <?= $model->status ?>"><?= \Yii::t('app', $model->status ) ?></span>
    </h2>
    <p>
        <?php if ( $canEditOrDelete ): ?>
            <?= Html::a(Yii::t('app', 'Update'),  Url::to(['update', 'id' => $model->id]), ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'),  Url::to(['delete', 'id' => $model->id]), [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>

        <?php if ( $model->status !== Tasks::STATUS_IN_WORK ): ?>
            <?= Html::a(Yii::t('app', 'In Work'), Url::to([
                'status', 'id' => $model->id, 'status' => Tasks::STATUS_IN_WORK
            ]), ['class' => 'btn btn-info'])
            ?>
        <?php endif; ?>

        <?php if ( $model->status !== Tasks::STATUS_COMPLETE ): ?>
            <?= Html::a(Yii::t('app', 'Complete'), Url::to([
                'status', 'id' => $model->id, 'status' => Tasks::STATUS_COMPLETE
            ]), ['class' => 'btn btn-success'])
            ?>
        <?php endif; ?>

        <?php if ( $model->status !== Tasks::STATUS_COMPLETE && $model->status !== Tasks::STATUS_CANCELED ): ?>
            <?= Html::a(Yii::t('app', 'Cancel'), Url::to([
                'status', 'id' => $model->id, 'status' => Tasks::STATUS_CANCELED
            ]), ['class' => 'btn btn-warning'])
            ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'title',
            'status',
            [
                'label' => Yii::t('app', 'executor'),
                'attribute' => 'execute_user_id',
                'value' => function($model) {
                    /** @var $model common\models\Tasks */
                    return $model->executeUser->username;
                }
            ],

            [
                'label' => Yii::t('app', 'project'),
                'attribute' => 'project_id',
                'format' => 'raw',
                'value' => function($model) {
                    /** @var $model common\models\Tasks */
                    $project = !$model->is_template ? $model->project : null;
                    return $project ? Html::a( $project->name, ['projects/view', 'id' => $project->id ] ) : null;
                }
            ],

            [
                'label' => Yii::t('app', 'creator'),
                'attribute' => 'project_id',
                'format' => 'raw',
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
    ]) ?>

    <?php if ( !$model->is_template ): ?>
        <?= Chat::widget(['task_id' => $model->id, 'project_id' => $model->project_id ]) ?>
    <?php endif; ?>
</div>