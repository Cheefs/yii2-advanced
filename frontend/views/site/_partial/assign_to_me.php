<?php
/** @var $tasks \common\models\Tasks[] */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="panel panel-success">
    <div class="panel-heading">My Tasks</div>
    <div class="panel-body page_main">

        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>T</th>
                    <th>Priority</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Project</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr class="active_row" onclick="location.href='tasks/view?id=<?= $task->id ?>'">
                        <td><i class="<?= $task->type->icon ?>"></i></td>

                        <td><?= $task->priority->title ?></td>
                        <th><?= $task->title ?></th>
                        <th><?= $task->status ?></th>
                        <th>
                            <?php
                                $poject = $task->project;
                               echo Html::a($poject->name, Url::to(['projects/view', 'id' => $poject->id]));
                            ?>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>