<?php

use yii\helpers\Url;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <!--   @todo подставлять фото пользователя, завести таблицу профилей    -->
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Priority', 'icon' => 'exchange', 'url' => Url::to(['/priority'])],
                    [
                        'label' => 'Tasks',
                        'icon' => 'tasks',
                        'items' => [
                            ['label' => 'Tasks List', 'icon' => 'file-text-o', 'url' => Url::to(['/tasks']),],
                            ['label' => 'Task Types', 'icon' => 'tags', 'url' => Url::to(['/task-types']),],
                        ],
                    ],

                    [
                        'label' => 'Projects',
                        'icon' => 'industry',
                        'items' => [
                            ['label' => 'Projects List', 'icon' => 'file-text-o', 'url' => Url::to(['/projects']),],
                        ],
                    ],

                    [
                        'label' => 'Chat Log',
                        'icon' => 'commenting-o',
                        'items' => [
                            ['label' => 'Chat Log List', 'icon' => 'file-text-o', 'url' => Url::to(['/chat-log']),],
                        ],
                    ],

                    [
                        'label' => 'Auth',
                        'icon' => 'lock',
                        'url' => Url::to(['/auth']),
                    ],

                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
