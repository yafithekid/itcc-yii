<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "submissions".
 *
 * @property integer $id
 * @property integer $task_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $pathfile
 *
 * @property Tasks $task
 * @property Users $user
 */
class Submission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'submissions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'user_id', 'pathfile'], 'required'],
            [['id', 'task_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['pathfile'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'pathfile' => 'Pathfile',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
