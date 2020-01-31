<?php
/** @var $tasks \common\models\Tasks[] */

?>

<div class="panel panel-success">
    <div class="panel-heading">My Tasks</div>
    <div class="panel-body page_main">

        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>T</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Priority</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task->priority->title ?></td>
                        <td><?= $task->type ?></td>
                        <th><?= $task->title ?></th>
                        <th><?= $task->status ?></th>
                        <th><?= $task->project->name ?></th>
                    </tr>
                    <tr>
                        <td><?= $task->priority->title ?></td>
                        <td><?= $task->type ?></td>
                        <th><?= $task->title ?></th>
                        <th><?= $task->status ?></th>
                        <th><?= $task->project->name ?></th>
                    </tr>
                    <tr>
                        <td><?= $task->priority->title ?></td>
                        <td><?= $task->type ?></td>
                        <th><?= $task->title ?></th>
                        <th><?= $task->status ?></th>
                        <th><?= $task->project->name ?></th>
                    </tr>
                    <tr>
                        <td><?= $task->priority->title ?></td>
                        <td><?= $task->type ?></td>
                        <th><?= $task->title ?></th>
                        <th><?= $task->status ?></th>
                        <th><?= $task->project->name ?></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>