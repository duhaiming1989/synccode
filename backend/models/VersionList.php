<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21 0021
 * Time: 下午 4:04
 */

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;


class VersionList extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName ()
    {
        return 'version_list';
    }

    /**
     * @return $this
     * 查询版本号列表
     */
    public static function getVersionList ( $query = [] )
    {
        return static::find()->where( $query )->orderBy('id DESC');
    }


    public static function getProjectJoinVesionList ( $data = [] )
    {
        return static::find()->select( 'project_list.* , version_list.*' )->join( 'LEFT JOIN', ProjectList::tableName(), 'project_list.id = version_list.project_id' );
    }

    public static function getVesionInfoByProjectid ( $project_id )
    {
        return static::find()->where( [ 'status' => 0, 'project_id' => $project_id ] )->orderBy( 'id DESC' )->limit( 1 )->asArray()->one();
    }


    public $project_name = '';

    public function attributeLabels ()
    {
        return [
            'id' => 'ID',
            'version' => '版本号',
            'add_time' => '提交时间',
            'author' => '提交人',
//            'project_name' => '11'
        ];
    }
}