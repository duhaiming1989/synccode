<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21 0021
 * Time: 下午 6:28
 */

namespace backend\controllers;
use backend\models\Deployinfo;
use backend\models\ProjectList;
use backend\models\VersionList;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class DeployinfoController extends Controller
{

    public function actionIndex()
    {
        $project_id = Yii::$app->request->get('project_id');
        $data = [
            'model' => new Deployinfo()
        ];

        $data['dataProvider'] = new ActiveDataProvider([
            'query' => VersionList::getVersionList(['status' => 0 ,'project_id' =>$project_id ])
        ]);
        $data['project_id'] = $project_id;

        $projectInfo = ProjectList::getProjectInfoByid($project_id);
        if(empty($projectInfo))
        {
            echo '未找到该项目';exit;
        }

        $rootPath = Yii::$app->basePath .'/exclude/';
        $filePath = $rootPath . $projectInfo['project_name'] . '.list';

        $data['model']->blackIps = file_get_contents($filePath);
        
        return $this->render('index' ,$data);
    }


    public function actionPush()
    {
        echo 12121;exit;
    }
}