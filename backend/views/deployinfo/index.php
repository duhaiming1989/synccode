<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21 0021
 * Time: 下午 6:46
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

$form = ActiveForm::begin( [ 'id' => 'blackListId' ] );
echo $form->field( $model, 'blackIps' )->textarea( [ 'rows' => 10, 'style' => 'margin-top:20px' ] );
echo Html::button( '更新', [ 'class' => 'btn btn-primary' ] );
ActiveForm::end();

$dataProvider->setSort( false );
echo GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'version',
            'author',
            'add_time',
            [
                'label' => '操作',
                'format' => 'raw',
                'value' => function ( $data )
                {
                    return '<span class="btn btn-primary deployClass" data-id ="' . $data->id . '" >发布</span>';
                },
            ]
        ]
    ]
);

?>
<script type="application/javascript">
    jQuery('.deployClass').click(function () {
        alert('发布')
    });



</script>
