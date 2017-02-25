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
            [['level', 'pid', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['title'], 'string', 'max' => 40],
            [['desc'], 'string', 'max' => 200],
            [['path_alias'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'desc' => 'Desc',
            'level' => '1.单元  2.子单元 3. 子子单元 ',
            'pid' => 'Pid',
            'path_alias' => '一级.二级...',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
