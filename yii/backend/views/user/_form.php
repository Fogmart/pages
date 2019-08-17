<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    td {
        padding: 8px;
    }
</style>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status' )
        ->dropDownList(\common\models\User::USER_STATUSES) ?>

    <label class="control-label" >Группы</label>
    <div class="row">
        <div class="col-md-6">
    <table cellpadding="3" cellspacing="5" border="1" style="margin-bottom: 20px">
        <tr>
            <td>Название</td>
            <td>Читать</td>
            <td>Изменять</td>
        </tr>

        <?php
        $read = $model->getReadGroups();
        $edit = $model->getEditGroups();
        foreach ($groups as $group){?>
            <tr>
                <td><?=$group->name?></td>
                <td><input type="checkbox" value="<?=$group->id?>" name="groups_read[]"
                        <?php if (in_array($group->id,$read)) {
                            echo "checked";
                        }?>
                    ></td>
                <td><input type="checkbox" value="<?=$group->id?>" name="groups_edit[]"
                        <?php if (in_array($group->id,$edit)) {
                            echo "checked";
                        }?>
                    ></td>
            </tr>
        <?php } ?>
    </table>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'canadmin')->checkbox() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
