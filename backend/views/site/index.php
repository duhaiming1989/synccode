<?php

/* @var $this yii\web\View */

$this->title = '基础平台代码部署首页';
use yii\grid\GridView;
use yii\helpers\Html;

$dataProvider->setSort( false );
?>
<div class="site-index">
    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'project_name',
            [
                'label' => '版本号',
                'value' => function ( $data )
                {
                    $vesionInfo = \backend\models\VersionList::getVesionInfoByProjectid( $data->id );
                    return $vesionInfo['version'];
                },
                'headerOptions' => [ 'width' => '460' ]
            ],
            [
                'label' => '最后更新时间',
                'value' => function ( $data )
                {
                    $vesionInfo = \backend\models\VersionList::getVesionInfoByProjectid( $data->id );
                    return $vesionInfo['add_time'];
                },
                'headerOptions' => [ 'width' => '160' ]
            ],
            [
                'label' => '作者',
                'value' => function ( $data )
                {
                    $vesionInfo = \backend\models\VersionList::getVesionInfoByProjectid( $data->id );
                    return $vesionInfo['author'];
                },
                'headerOptions' => [ 'width' => '100' ]
            ],
            [
                'attribute' => '操作',
                'format' => 'raw',
                'value' => function ( $data )
                {
                    return Html::a( '<span class="btn btn-primary">部署</span>', '/deployinfo/index?project_id=' . $data->id, [ 'title' => '部署' ] );
                },
                'headerOptions' => [ 'width' => '80' ]
            ]
        ],
    ]
    ) ?>
</div>
