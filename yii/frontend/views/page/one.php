<?php
use rmrevin\yii\module\Comments;
use common\models\User; ?>
<div class="body-content">
    <div class="row">
        <div class="col-md-10">

            <h2>
                <?= $page->title ?>
            </h2>
            <?php if ($page->type_id == 0) { ?>
                <p><?= $page->text ?></p>
            <?php } ?>

            <?php if ($page->type_id == 1) { ?>
                <iframe src="<?= $page->fullPhpUrl ?>" name="mainframe" width="100%"></iframe>
            <?php } ?>
        </div>
        <div class="col-md-2">

            <?php
            $user = User::findIdentity(Yii::$app->user->identity->getId());

            if (($user->getIsUserGroupEdt($groupid)) && ($page->type_id == 0)) { ?>
                <?= \yii\bootstrap\Html::a('Изменить',
                    ['page/update', 'id' => $page->id, "groupid" => $groupid],
                    ['class' => 'btn btn-success']) ?>
            <?php } ?>
        </div>



    </div>


    <div style="border-top: solid;margin-top: 85px;">
        <?= Comments\widgets\CommentListWidget::widget([
            'entity' => (string) 'page'.$page->id,
        ]);?>
    </div>