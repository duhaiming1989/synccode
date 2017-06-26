<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/26 0026
 * Time: 上午 11:20
 */

namespace backend\models;

use yii;
use yii\db\ActiveRecord;

class Gitpull extends ActiveRecord
{

    public static function tableName ()
    {
        return 'version_list';
    }

    public function upVersionInfoByid ( $id, $version, $rsyncUser )
    {
        $isTrue = true;
        $dbTransaction = Yii::$app->db->beginTransaction();

        $queryData = self::find()->where( 'id < :id AND status = :status ', [ ':id' => $id, ':status' => 0 ] )->asArray()->all();
        if ( !empty( $queryData ) )
        {
            foreach ( $queryData as $queryInfo )
            {
                $setdata = [
                    'status' => 2,
                    'up_time' => date( 'Y-m-d H:i:s' )
                ];
                $queryCondition = ' id = :id AND `version` = :versionid ';
                $params = [
                    ':id' => $queryInfo['id'],
                    ':versionid' => $queryInfo['version']
                ];
                $isTrue = Yii::$app->db->createCommand()->update( self::tableName(), $setdata, $queryCondition, $params )->execute();
                if ( !$isTrue )
                {
                    $isTrue = false;
                    continue;
                }
            }
        }

        if ( $isTrue )
        {
            $condition = ' id = :id AND  `version` = :versionid';
            $params = [ ':id' => $id, ':versionid' => $version ];
            $upData = [
                'status' => 1,
                'up_time' => date( 'Y-m-d H:i:s' ),
                'rsync_author' => $rsyncUser
            ];
            $isTrue = Yii::$app->db->createCommand()->update( self::tableName(), $upData, $condition, $params )->execute();
        }
        if ( $isTrue )
        {
            $dbTransaction->commit();
            return true;
        }
        else
        {
            $dbTransaction->rollBack();
            return false;
        }
    }
}