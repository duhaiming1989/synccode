<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21 0021
 * Time: 下午 6:28
 */

namespace backend\controllers;
use backend\models\Deployinfo;
use Yii;
use yii\web\Controller;

class DeployinfoController extends Controller
{

    public function actionIndex()
    {
        $data = [
            'model' => new Deployinfo()
        ];
        return $this->render('index' ,$data);
    }
}