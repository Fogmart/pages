<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Страницы', 'icon' => 'dashboard', 'url' => ['/page']],
                    ['label' => 'Группы', 'icon' => 'dashboard', 'url' => ['/group']],
                    ['label' => 'Присовоение групп', 'icon' => 'dashboard', 'url' => ['/page/assign']],
                    ['label' => 'Пользователи', 'icon' => 'dashboard', 'url' => ['/user']],
                    ['label' => 'Выход', 'url' => ['site/logout'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Вход', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                ],
            ]
        ) ?>

    </section>

</aside>
