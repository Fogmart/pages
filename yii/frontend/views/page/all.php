<?php

/*@var $pages \common\models\Page*/
?>

<div class="body-content">
    <div class="row">
        <div class="col-md-10">
            <?php use common\models\User;

            foreach ($pages as $page): ?>
                <div class="col-md-12">
                    <h2><?=$page->title?></h2>

                    <p><?=$page->text?></p>
                    <?=\yii\bootstrap\Html::a('подробнее...',
                            ['page/one', 'url'=>$page->url, "groupid"=>$groupid],
                            ['class'=>'btn btn-success']) ?>
                </div>
            <?php endforeach; ?>
        </div>

       <div class="col-md-2">
        <?php
        $user = User::findIdentity(Yii::$app->user->identity->getId());

        if ($user->getIsUserGroupEdt($groupid)) {?>
            <?=\yii\bootstrap\Html::a('Добавить',
                ['page/create', "groupid"=>$groupid],
                ['class'=>'btn btn-success']) ?>
        <?php } ?>
      </div>
</div>
