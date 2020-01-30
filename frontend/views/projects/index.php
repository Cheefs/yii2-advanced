<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Projects'), Url::to(['create']), ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'format' => 'raw',
                'label' => Yii::t('app', 'parent project'),
                'attribute' => 'parent_id',
                'value' => function( $model ) {
                    /** @var $model common\models\Projects */
                    $parent = $model->parent;
                    return $parent ? Html::a($parent->name,  Url::to(['/projects/view', 'id' => $parent->id]) : null ;
                }
            ],
            [
                'label' => ucfirst( Yii::t('app', 'creator') ),
                'attribute' => 'create_user_id',
                'value' => function( $model ) {
                    /** @var $model common\models\Projects */
                    return $model->createUser->username;
                }
            ],
            [
                'format' => 'raw',
                'attribute' => 'create_at',
                'value' => function( $model ) {
                    /** @var $model common\models\Projects */
                    return Yii::$app->formatter->asDatetime( $model->create_at );
                }
            ],
            [
                'format' => 'raw',
                'attribute' => 'update_at',
                'value' => function( $model ) {
                    /** @var $model common\models\Projects */
                    return Yii::$app->formatter->asDatetime( $model->update_at );
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
