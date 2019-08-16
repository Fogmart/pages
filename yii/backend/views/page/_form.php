<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>
<script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
<script>
    $(function () {
        showFields()
    })
    function showFields() {
        if ($("#type_id").val() == 1) {
            $(".txt").hide()
            $(".php").show()
        } else{
            $(".php").hide()
            $(".txt").show()
        }
    }
</script>

<div class="page-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype'=>'multipart/form-data']
        ]); ?>
    <?= $form->field($model, 'type_id' )
        ->dropDownList(\common\models\Page::PAGE_TYPES,
                [
                        'id'=> "type_id",
                        'onchange' => 'showFields()']
        ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="php">
        <?= $form->field($model, 'phpurl')->textInput(['maxlength' => true]) ?>
    </div>
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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
