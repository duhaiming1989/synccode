<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22 0022
 * Time: 上午 10:01
 */

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

class ProjectList extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules ()
    {
        return [
            [ [ 'project_name' ], 'required', 'message' => '请填写项目名称' ],
            [ [ 'project_path' ], 'required', 'message' => '请填写项目路径' ],
            [ [ 'type' ], 'required', 'message' => '请填写代码库类型' ],
            [ [ 'type' ], 'integer' ],
            [ [ 'project_name', 'project_path' ], 'safe' ],
            [ [ 'add_time', 'rsync_pass', 'ip', 'module_name' ,'user' ], 'string' ]
        ];
    }

    public static function tableName ()
    {
        return 'project_list';
    }

    public static function getProjectList ( $data = [] )
    {
        return static::find()->where( [] );
    }

    public static function getProjectInfoByid ( $id )
    {
        return static::find()->where( [ 'id' => $id ] )->asArray()->one();
    }


    public static function getProjectJoinVesionList ( $data = [] )
    {
        return static::find()->join( 'JOIN', Deployinfo::tableName(), 'project_list.id = version_list.project_id' );
    }

    public function attributeLabels ()
    {
        return [
            'id' => 'ID',
            'project_name' => '项目名称',
            'add_time' => '添加时间',
            'project_path' => '项目路径',
            'type' => '库类型',
            'rsync_pass' => '同步密码文件',
            'ip' => '目标IP',
            'module_name' => '同步模块名',
            'user' => '用户'
        ];
    }
}