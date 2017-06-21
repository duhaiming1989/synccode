<?php

/* @var $this yii\web\View */

$this->title = '基础平台代码部署首页';
use yii\grid\GridView;
use yii\helpers\Html;
$dataProvider->setSort(false);
?>
<div class="site-index">
    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'version',
            'add_time',
            'author',
            [
                'attribute' => '操作',
                'format' => 'raw',
                'value' => function(){
                    return
                        Html::a('<span class="btn btn-primary">部署</span>', '/deployinfo/index', ['title' => '部署'] );
                },
                'headerOptions' => ['width' => '80'],
            ]
        ],
    ]) ?>
</div>
