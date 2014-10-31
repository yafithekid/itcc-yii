<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $course_id
 * @property integer $id
 * @property string $created_at
 * @property string $deadline
 * @property integer $user_id
 *
 * @property Submissions[] $submissions
 * @property Courses $course
 * @property Users $user
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'id', 'user_id','title'], 'required'],
            [['course_id', 'id', 'user_id'], 'integer'],
            [['created_at', 'deadline'], 'safe'],
            [['title'],'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Kuliah',
            'id' => 'ID',
            'created_at' => 'Created At',
            'deadline' => 'Deadline',
            'user_id' => 'User ID',
            'title' => 'Judul',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubmissions()
    {
        return $this->hasMany(Submissions::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
