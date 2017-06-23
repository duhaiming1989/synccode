<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22 0022
 * Time: 下午 7:29
 */

namespace backend\controllers;
use backend\models\ProjectList;
use Yii;
use yii\web\Controller;

class BlackipController extends Controller
{
    public function actionIndex()
    {
//        print_r($_POST);exit;
        $projectId = Yii::$app->request->get('project_id');
        $projectInfo = ProjectList::getProjectInfoByid($projectId);
        if(empty($projectInfo))
        {
            echo '未找到该项目';exit;
        }
        $rootPath = Yii::$app->basePath .'/exclude/';
        $filePath = $rootPath . $projectInfo['project_name'] . '.list';
        $Deployinfo = Yii::$app->request->post('Deployinfo');
        $isTrue = file_put_contents($filePath ,$Deployinfo['blackIps'] );
        if($isTrue)
        {
//            echo "/deployinfo/index?project_id={$projectId}";exit;
            header("Location: /deployinfo/index?project_id={$projectId}");exit;
        }
        else
        {
            echo '写入失败';exit;
        }
    }
}