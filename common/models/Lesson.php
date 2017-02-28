<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zixisi_lesson".
 *
 * @property string $id
 * @property integer $course_id
 * @property integer $chapter_id
 * @property string $title
 * @property string $desc
 * @property string $content
 * @property integer $created_time
 * @property integer $updated_time
 * @property integer $delete_time
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zixisi_lesson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'chapter_id', 'title'], 'required'],
            [['course_id', 'chapter_id', 'status', 'order'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 40],
            [['desc'], 'string', 'max' => 500],
        ];
    }

    public function getCourse()
    {
    	return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
    
    public function getChapter()
    {
    	return $this->hasOne(Chapter::className(), ['id' => 'chapter_id']);
    }
    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => '所属课程',
            'chapter_id' => '所属单元',
            'title' => '内容标题',
            'status' => '状态',
            'order' => '排序顺序',
            'desc' => '简介',
            'content' => '内容',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'deleted_at' => '删除时间',
        ];
    }
}
