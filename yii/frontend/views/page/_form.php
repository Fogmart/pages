<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype'=>'multipart/form-data']
        ]); ?>

    <input type="hidden" name="type_id" value="<?=$model->type_id?>">
    <input type="hidden" name="groupid" value="<?=$groupid?>">


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="txt">
        <?= $form->field($model, 'text')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'clips',
                    'fullscreen',
                ],
                'clips' => [
                    ['Lorem ipsum...', 'Lorem...'],
                    ['red', '<span class="label-red">red</span>'],
                    ['green', '<span class="label-green">green</span>'],
                    ['blue', '<span class="label-blue">blue</span>'],
                ],
                'imageUpload' => \yii\helpers\Url::to(['/site/save-redactor-image', 'sub' => 'page']),
            ],
        ]);
        ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'url',['options'=>['class'=>'col-md-6']]  )->textInput(['maxlength' => true]) ?>
    </div>

    <div style="display: none">
    <?= $form->field($model, 'groups_arr')->widget(Select2::classname(), [
            'data' =>
                \yii\helpers\ArrayHelper::map(\common\models\Group::find()->all(), 'id', 'name'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Выбрать группу', 'multiple'=> true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
