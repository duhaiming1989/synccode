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
    public static function tableName()
    {
        return 'version_list';
    }

    /**
     * @return $this
     * 查询版本号列表
     */
    public static function getVersionList($query =[])
    {
        return static::find()->where($query);
    }

    public  function attributeLabels ()
    {
        return [
            'id' => 'ID',
            'version' => '版本号',
            'add_time' => '提交时间',
            'author' => '提交人'
        ];
    }
}