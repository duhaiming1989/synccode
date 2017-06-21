<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21 0021
 * Time: 下午 6:55
 */

namespace backend\models;
use Yii;
use yii\db\ActiveRecord;

class Deployinfo extends ActiveRecord
{

    public static function tableName ()
    {
        return 'version_list';
    }

    public $blackIps;


    public function attributeLabels ()
    {
        return [
            'blackIps' => '项目黑名单列表：'
        ];
    }

}