<?php
 /** @var $tasks array */
 /** @var $activityList array */
?>

<div class="container">
  <h1 class="text-uppercase"> task tracker</h1>
  <div class="row">
        <div class="col-sm-6">
            <?= $this->render('_partial/introduction') ?>
            <?= $this->render('_partial/help') ?>
        </div>

        <div class="col-sm-6">
            <?= $this->render('_partial/assign_to_me', [ 'tasks' => $tasks ]) ?>
            <?= $this->render('_partial/last_activity', [ 'activityList' => $activityList ]) ?>
        </div>
   </div>
</div>