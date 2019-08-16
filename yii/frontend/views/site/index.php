<?php

/* @var $this yii\web\View */


$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <?php foreach ($pages as $page): ?>
            <div class="col-lg-4">
                <h2><?=$page->title?></h2>

                <p><?=$page->text?></p>
                <?=\yii\bootstrap\Html::a('подробнее...',
                    ['page/one', 'url'=>$page->url],
                    ['class'=>'btn btn-success']) ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
