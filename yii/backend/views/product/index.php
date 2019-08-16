<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">


    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php \yii\widgets\Pjax::begin()?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                ["attribute"=>"sklad_id",
                    'value'=>function($model){ return $model->sklad->title;},
                    'filter'=>\common\models\Sklad::getList()
                    ],
                'title',
                'cost',
                'type_id',
                //'text:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    <?php \yii\widgets\Pjax::end()?>

</div>
