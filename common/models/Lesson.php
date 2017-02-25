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
            [['course_id'], 'required'],
            [['course_id', 'chapter_id', 'created_time', 'updated_time', 'delete_time'], 'integer'],
            [['content'], 'string'],
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
            'course_id' => 'Course ID',
            'chapter_id' => 'Chapter ID',
            'title' => 'Title',
            'desc' => 'Desc',
            'content' => 'Content',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'delete_time' => 'Delete Time',
        ];
    }
}
