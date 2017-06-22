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
    public static function tableName ()
    {
        return 'project_list';
    }

    public static function getProjectList ( $data = [] )
    {
        return static::find()->where( [] );
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

        ];
    }
}