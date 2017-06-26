<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21 0021
 * Time: 下午 6:28
 */

namespace backend\controllers;

use backend\models\Deployinfo;
use backend\models\Gitpull;
use backend\models\ProjectList;
use backend\models\VersionList;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class DeployinfoController extends Controller
{

    public function actionIndex ()
    {
        $project_id = Yii::$app->request->get( 'project_id' );
        $data = [
            'model' => new Deployinfo()
        ];

        $data['dataProvider'] = new ActiveDataProvider( [
                'query' => VersionList::getVersionList( [ 'status' => 0, 'project_id' => $project_id ] )
            ]
        );


        $data['dataProviderHistory'] = new ActiveDataProvider( [
                'query' => VersionList::getVersionList( [ 'status' => 1, 'project_id' => $project_id ] )
            ]
        );


        $data['project_id'] = $project_id;

        $projectInfo = ProjectList::getProjectInfoByid( $project_id );
        if ( empty( $projectInfo ) )
        {
            echo '未找到该项目';
            exit;
        }

        $rootPath = Yii::$app->basePath . '/exclude/';
        $filePath = $rootPath . $projectInfo['project_name'] . '.list';
        if ( file_exists( $filePath ) )
        {
            $data['model']->blackIps = file_get_contents( $filePath );
        }
        else
        {
            file_put_contents( $filePath, '' );
            $data['model']->blackIps = '';
        }


        return $this->render( 'index', $data );
    }


    public function actionPush ()
    {
        $id = Yii::$app->request->post( 'id' );
        $version = Yii::$app->request->post( 'version' );
        $rootPath = Yii::$app->basePath;
//        $shell = $rootPath.'/Shell/rsync.sh';
//        $command = '/bin/bash ' . $shell;
//        exec( $command, $output, $return_var );
        $return_var = 0;

        $Gitpull = new Gitpull();
        $isUp = $Gitpull->upVersionInfoByid( $id, $version, Yii::$app->user->identity->username );
        if ( $return_var == 0 && $isUp == true )
        {
            return json_encode( [ 'status' => 1, 'msg' => '', [] ] );
        }
        else
        {
            return json_encode( [ 'status' => 0, 'msg' => '', [] ] );
        }
    }
}