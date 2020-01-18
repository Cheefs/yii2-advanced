<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
/* @var $projectsList common\models\Projects[]  */
/* @var $usersList common\models\User[] */
/* @var $priorityList common\models\User[] */
/* @var $templatesList common\models\Tasks[] */

$templatesDropDown = ArrayHelper::map( $templatesList, 'id', 'title');
$templatesDropDown[ -1 ] = Yii::t('app','dont use');

?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'is_template')->checkbox([
        'class' => 'checkbox_template',
    ])->label( false ) ?>
    <div class="templates_select">
        <?=  Html::dropDownList(
                'template',
                -1,
            $templatesDropDown ?? [],
            ['class' => 'form-control' ]
        ) ?>
        <?= Html::hiddenInput('templates_json', Json::encode( $templatesList ), ['id' => 'templates_values'] ) ?>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'form-control task__title']) ?>

    <?= $form->field($model, 'execute_user_id')
        ->dropDownList( $usersList ?? [], [
            'class' => 'form-control executor__id',
            'prompt' => Yii::t('app', '')
        ])
        ->label('executor')
    ?>

    <?= $form->field($model, 'project_id')->dropDownList(
        $projectsList ?? [], [
            'class' => 'form-control project__id',
            'prompt' => Yii::t('app', '')
        ]
    )->label('project') ?>

    <?= $form->field($model, 'type')->dropDownList([
            'task' => 'Task', 'error' => 'Error', 'epic' => 'Epic', 'subtask' => 'Subtask'
    ], ['class' => 'form-control task__type']) ?>

    <?= $form->field($model, 'priority_id')
        ->dropDownList( $priorityList ?? [], ['class' => 'form-control priority__id'])
        ->label('priority')
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    /** берем в контроль все нужные дом элементы */
    const $templatesSelectNode = document.querySelector('.templates_select');
    const $templatesValuesNode = document.querySelector('#templates_values');

    const $taskTypeNode = document.querySelector('.task__type');
    const $taskPriorityNode = document.querySelector('.priority__id');
    const $taskProjectNode = document.querySelector('.project__id');
    const $taskExecutorNode = document.querySelector('.executor__id');
    const $taskTitleNode = document.querySelector('.task__title');

    /** Проверяем наличие шаблонов и парсим эту JSON строку */
    const templates = $templatesValuesNode ? JSON.parse( $templatesValuesNode.value ) : [];

    /**
     * функция подстановки данных шаблона в дом дерево
     * @param template object
     **/
    const setTask = ( template ) => {
        const { type, priority_id, project_id, execute_user_id, title } = template;
        if ( template ) {
            $taskTypeNode.value = type;
            $taskPriorityNode.value = priority_id;
            $taskProjectNode.value = project_id;
            $taskExecutorNode.value = execute_user_id;
            $taskTitleNode.value = title;
        }
    };

    /** слушаем все клики по документу */
    document.addEventListener('click', ( event ) => {
        const { target } = event;
        /** обработка клика по чекбоксу использование шаблона ( прячем селект с шаблонами если делаем новый шаблон ) */
        if ( target && target.classList.contains('checkbox_template') ) {
            const { checked } = target;
            if ( checked ) {
                $templatesSelectNode.classList.add('hide');
            } else {
                $templatesSelectNode.classList.remove('hide');
            }
        }
    });
    /** проверяем наличие селект листа шаблонав в дом дереве */
    if ( $templatesSelectNode ) {
        /** подписываемся на событие, и обновляем данные формы при изменении значения селект листа */
        $templatesSelectNode.addEventListener('change', ( event ) => {
            const { target: { value } } = event;
            const selectedTemplate = templates.find( ({ id }) => +id === +value );

            setTask( selectedTemplate );
        });
    }
</script>
