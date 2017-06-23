<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\ProjectList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field( $model, 'project_name' )->textInput( [ 'maxlength' => true ] ) ?>

    <?= $form->field( $model, 'project_path' )->textInput( [ 'maxlength' => true ] ) ?>

    <?= $form->field( $model, 'type' )->listBox( [ 1 => 'GIT', 2 => 'SVN' ], [ 'prompt' => '请选择', 'size' => 1 ] ) ?>

    <div class="form-group">
        <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>

//    $(document).ready(function(){
//        $(function () {
//            $('#projectlist-add_time').datepicker({
////                language: "zh-CN",
//                autoclose: true,//选中之后自动隐藏日期选择框
//                clearBtn: true,//清除按钮
//                format: "yyyy-mm-dd"//日期格式，详见 http://bootstrap-datepicker.readthedocs.org/en/release/options.html#format
//            });
//        });
//    });
</script>

