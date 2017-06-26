<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/26 0026
 * Time: 上午 11:09
 */

namespace backend\controllers;

use backend\models\ProjectList;
use Yii;
use yii\web\Controller;

class GitpullController extends Controller
{

    public function actionIndex ()
    {
        $projectInfo = '{"object_kind":"push","event_name":"push","before":"2e64e7e4787471f783a53572470125f0dd631fa4","after":"da85bc1fb80327bf8aeceba2fc4bec5a20dd277f","ref":"refs/heads/dev.youmeng.com","checkout_sha":"da85bc1fb80327bf8aeceba2fc4bec5a20dd277f","message":null,"user_id":10,"user_name":"wangjin","user_email":"2355431009@qq.com","user_avatar":"http://www.gravatar.com/avatar/d89756d8b11ba42c38472455f8b12097?s=80\u0026d=identicon","project_id":11,"project":{"name":"youmeng.com","description":"youmeng.com","web_url":"http://192.168.10.32/base/youmeng.com","avatar_url":null,"git_ssh_url":"git@192.168.10.32:base/youmeng.com.git","git_http_url":"http://192.168.10.32/base/youmeng.com.git","namespace":"base","visibility_level":0,"path_with_namespace":"base/youmeng.com","default_branch":"master","homepage":"http://192.168.10.32/base/youmeng.com","url":"git@192.168.10.32:base/youmeng.com.git","ssh_url":"git@192.168.10.32:base/youmeng.com.git","http_url":"http://192.168.10.32/base/youmeng.com.git"},"commits":[{"id":"da85bc1fb80327bf8aeceba2fc4bec5a20dd277f","message":"b.product_id\n","timestamp":"2017-05-20T17:36:16+08:00","url":"http://192.168.10.32/base/youmeng.com/commit/da85bc1fb80327bf8aeceba2fc4bec5a20dd277f","author":{"name":"wangjin","email":"you@example.com"},"added":[],"modified":["application/models/ReportDetailModel.php"],"removed":[]}],"total_commits_count":1,"repository":{"name":"youmeng.com","url":"git@192.168.10.32:base/youmeng.com.git","description":"youmeng.com","homepage":"http://192.168.10.32/base/youmeng.com","git_http_url":"http://192.168.10.32/base/youmeng.com.git","git_ssh_url":"git@192.168.10.32:base/youmeng.com.git","visibility_level":0}}';
//        $projectInfo = file_get_contents( 'php://input' );
        $projectInfo = json_decode( $projectInfo, true );
        if ( !empty( $projectInfo ) )
        {
            $reposName = $projectInfo['repository']['name'];
            $projectInfo = ProjectList::getProjectList( [ 'project_name' => $reposName ] )->asArray()->one();
            $rootPath = Yii::$app->basePath;
            $pullSh = Yii::$app->basePath . '/Shell/gitpull.sh';
            $excludeFrom = Yii::$app->basePath . '/exclude/' . $reposName . '.list';
            $command = '/bin/bash ' . $pullSh . ' ' .
                $reposName . ' ' . $projectInfo['project_path'] . ' ' .
                WEBPATH . ' ' . GITBIN . ' ' . RSYNCPASS . ' ' . $excludeFrom;
            $nowDate = date('Y-m-d H:i:s');
            $logPath = Yii::$app->basePath .'/runtime/logs/gitpull.log';
            exec( "echo $nowDate  $command  >> $logPath  ;$command >> $logPath  ", $output, $return_var );

            exit;
        }
    }
}