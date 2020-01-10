<?php
/** @var $tasks array */

/** набросал для вида, пока нет моделей, потом таблица будет строится через grid view */
?>

<div class="panel panel-success">
    <div class="panel-heading">My Tasks</div>
    <div class="panel-body">
        <table class="table table-striped">
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
                    <td><?= $task->type ?></td>
                    <th><?= $task->name ?></th>
                    <th><?= $task->description ?></th>
                    <th><?= $task->priority ?></th>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>