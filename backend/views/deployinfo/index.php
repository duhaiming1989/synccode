<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21 0021
 * Time: 下午 6:46
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin( [ 'id' => 'blackListId' ] );
echo $form->field( $model, 'blackIps' )->textarea( [ 'rows' => 10, 'style' => 'margin-top:20px' ] );
echo Html::button('更新',['class' => 'btn btn-primary']);
ActiveForm::end();


