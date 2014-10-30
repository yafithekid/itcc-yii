<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property integer $id
 * @property string $name
 * @property string $department_id
 * @property integer $semester
 * @property integer $is_available
 * @property string $description
 *
 * @property Departments $department
 * @property Tasks[] $tasks
 * @property UserCourses[] $userCourses
 * @property Users[] $users
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'department_id'], 'required'],
            [['semester', 'is_available'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['department_id'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'department_id' => 'Department ID',
            'semester' => 'Semester',
            'is_available' => 'Is Available',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCourses()
    {
        return $this->hasMany(UserCourses::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['id' => 'user_id'])->viaTable('user_courses', ['course_id' => 'id']);
    }
}
