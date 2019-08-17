<?php


/* @var $this yii\web\View */
?>
<h1>Последние комментарии</h1>
<style>
    .headdiv{
        border-bottom: solid;
    }
</style
<p>
<div class="row" >
    <div class="col-md-3 headdiv"> Сообщение </div>
    <div class="col-md-3 headdiv"> Автор, когда </div>
    <div class="col-md-3 headdiv"> Страница </div>
</div>
    <?php foreach ($comments as $one) {?>
<div class="row">
    <div class="col-md-3"> <?=$one->text?> </div>
    <div class="col-md-3"> <?=$one->from?>,
        <?= date('H:i d.m.Y', $one->created_at) ?> </div>
    <div class="col-md-3"> <?=$one->page->title?> </div>
</div>
    <?php } ?>
</p>
