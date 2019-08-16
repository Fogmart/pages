<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = 'Update Page: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['one', 'url' => $model->url, "groupid"=>$groupid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-update">


    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'groupid' => $groupid,
    ]) ?>



</div>
