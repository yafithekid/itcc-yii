<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property string $id
 * @property string $name
 * @property string $faculty_id
 *
 * @property Courses[] $courses
 * @property Faculties $faculty
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'faculty_id'], 'required'],
            [['id'], 'string', 'max' => 2],
            [['id'],'unique'],
            [['name'], 'string', 'max' => 50],
            [['faculty_id'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'name' => 'Nama',
            'faculty_id' => 'Fakultas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Courses::className(), ['department_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculties::className(), ['id' => 'faculty_id']);
    }
}
