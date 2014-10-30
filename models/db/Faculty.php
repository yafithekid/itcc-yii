<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "faculties".
 *
 * @property string $id
 * @property string $name
 *
 * @property Departments[] $departments
 */
class Faculty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','id'], 'required'],
            [['id'],'unique'], 
            [['id'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID Fakultas',
            'name' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['faculty_id' => 'id']);
    }
}
