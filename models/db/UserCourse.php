<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "user_courses".
 *
 * @property integer $user_id
 * @property integer $course_id
 * @property integer $grade
 *
 * @property Users $user
 * @property Courses $course
 */
class UserCourse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'course_id'], 'required'],
            [['user_id', 'course_id', 'grade'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'course_id' => 'Course ID',
            'grade' => 'Grade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::className(), ['id' => 'course_id']);
    }
}
