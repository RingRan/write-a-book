<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zixisi_chapter".
 *
 * @property string $id
 * @property string $title
 * @property string $desc
 * @property integer $level
 * @property integer $pid
 * @property string $path_alias
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class Chapter extends \yii\db\ActiveRecord
{
	const STATUS_PREPARING = 1;
	const STATUS_PUBLISH   = 2;
	const STATUS_FORBIDDEN = 3;
	
	const LEVEL_FIRST  = 1;
	const LEVEL_SECOND = 2;
	const LEVEL_THIRD  = 3;
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zixisi_chapter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['title', 'desc', 'level', 'course_id'], 'required'],
            [['level', 'pid', 'status', 'course_id', 'order'], 'integer'],
            [['title'], 'string', 'max' => 40],
            [['desc'], 'string', 'max' => 200],
            [['path_alias'], 'string', 'max' => 50],
        ];
    }

    public function getCourse()
    {
    	return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '章节名称',
            'course_id' => '所属课程',
            'desc' => '章节简介',
            'level' => '层级',
            'pid' => '父章节',
            'status' => '状态',
            'order' => '显示顺序',
            'path_alias' => '路线别名',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'deleted_at' => '删除时间',
        ];
    }
}
