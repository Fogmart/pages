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



    <label class="control-label" >Группы</label>
    <table cellpadding="3" cellspacing="5" border="1">
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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
