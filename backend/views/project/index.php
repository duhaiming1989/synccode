<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchProjectInfo */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '项目列表';
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->setSort(false);
?>
<div class="project-list-index">

    <h1></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建项目', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'project_name',
            'project_path',
            [
                'label' => '库',
                //'type'
                'value' => function ($data){
                    if ($data->type == '1')
                    {
                        return 'GIT';
                    }
                    else
                    {
                        return 'SVN';
                    }
                }
            ],
            'rsync_pass',
            'user',
            'ip',
            'module_name',
            'add_time',
            ['class' => 'yii\grid\ActionColumn','header' => '操作'],
        ],
    ]); yii\grid\ActionColumn::className();?>
</div>
