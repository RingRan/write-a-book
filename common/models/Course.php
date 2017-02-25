<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zixisi_course".
 *
 * @property string $id
 * @property string $title
 * @property string $desc
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zixisi_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['title', 'desc'], 'required'],
            [['title'], 'string', 'max' => 40],
            [['desc'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'desc' => '简介',
            'status' => '状态',
            'created_at' => '创建日期',
            'updated_at' => '更新日期',
            'deleted_at' => '删除日期',
        ];
    }
}
