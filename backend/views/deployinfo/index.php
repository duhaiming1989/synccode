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

$form = ActiveForm::begin( [ 'id' => 'blackListId', 'action' => '/blackip/index?project_id=' . $project_id, 'method' => 'post' ] );
echo $form->field( $model, 'blackIps' )->textarea( [ 'rows' => 10, 'style' => 'margin-top:20px' ] );
echo Html::button( '更新', [ 'class' => 'btn btn-primary submitBlack' ] );
ActiveForm::end();
$dataProvider->setSort( false );
?>
<br/>
<?php
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
                    return '<span class="btn btn-primary deployClass" data-version="' . $data->version . '" data-id ="' . $data->id . '" >发布</span>';
                },
            ]
        ]
    ]
);

?>
<br/>
<h3>部署日志</h3>
<?php
$dataProviderHistory->setSort( false );
echo GridView::widget(
    [
        'dataProvider' => $dataProviderHistory,
        'columns' => [
            'id',
            'version',
            'author',
            'up_time',
            'rsync_author'
        ]
    ]
);
?>

<script type="application/javascript">

    $('.submitBlack').click(function () {
        $('#blackListId').submit();
    });


    jQuery('.deployClass').click(function () {
        var id = $(this).attr('data-id');
        var version = $(this).attr('data-version');
        $.post('/deployinfo/push', 'id=' + id + '&version=' + version, function (result) {
            if (result.status == 1) {
                alert('部署成功');
                window.location.reload();
            }
            else {
                alert('部署失败');
            }
        }, 'json');
    });
</script>
