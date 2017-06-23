<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectList */

$this->title = $model->project_name;
$this->params['breadcrumbs'][] = [ 'label' => '项目列表', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->id, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="project-list-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ]
    ) ?>

</div>
