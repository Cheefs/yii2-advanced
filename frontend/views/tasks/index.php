<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tasks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tasks'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'format' => 'raw',
                'attribute' => 'title',
                'value' => function($model) {
                    /** @var $model common\models\Tasks */
                    return Html::a($model->title, ['tasks/view', 'id' => $model->id ]);
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
            [
                'format' => 'html',
                'attribute' => 'is_template',
                'value' => function($model) {
                    /** @var $model common\models\Tasks */
                    $isTemplate = (boolean)$model->is_template;
                    return Html::tag('span',
                        $isTemplate ? Yii::t('app', 'template') : Yii::t('app', 'task'),
                      ['class' => 'label label-'. ( $isTemplate ? 'primary' : 'warning' ) ]
                    );
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
            'type',
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
                'attribute' => 'create_at',
                'value' => function($model) {
                    /** @var $model common\models\Tasks */
                    return Yii::$app->formatter->asDatetime( $model->create_at );
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>


