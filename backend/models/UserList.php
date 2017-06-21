<?php
namespace backend\models;
use Yii;
use yii\db\ActiveRecord;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21 0021
 * Time: 下午 3:19
 */
class UserList extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public static function getUserList ()
    {
        return static::find()->where([]);
    }

}