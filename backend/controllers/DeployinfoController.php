<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21 0021
 * Time: 下午 6:28
 */

namespace backend\controllers;
use backend\models\Deployinfo;
use backend\models\VersionList;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class DeployinfoController extends Controller
{

    public function actionIndex()
    {
        $data = [
            'model' => new Deployinfo()
        ];

        $data['dataProvider'] = new ActiveDataProvider([
            'query' => VersionList::getVersionList(['status' => 0])
        ]);

        return $this->render('index' ,$data);
    }


    public function actionPush()
    {
        echo 12121;exit;
    }
}