<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\skladSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sklads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sklad-index">


    <p>
        <?= Html::a('Create Sklad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'adress',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
