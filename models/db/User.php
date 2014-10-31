<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $fullname
 * @property string $school
 * @property integer $is_admin
 * @property integer $is_teacher
 * @property string $last_login
 * @property integer $is_online
 *
 * @property Contacts[] $contacts
 * @property Submissions[] $submissions
 * @property Tasks[] $tasks
 * @property UserCourses[] $userCourses
 * @property Courses[] $courses
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'fullname', 'school'], 'required'],
            [['is_admin', 'is_teacher', 'is_online'], 'integer'],
            [['last_login'], 'safe'],
            [['username', 'password', 'email', 'fullname', 'school'], 'string', 'max' => 127]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'fullname' => 'Fullname',
            'school' => 'School',
            'is_admin' => 'Admin',
            'is_teacher' => 'Dosen',
            'last_login' => 'Terakhir login',
            'is_online' => 'Online',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['contact_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubmissions()
    {
        return $this->hasMany(Submission::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCourses()
    {
        return $this->hasMany(UserCourse::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['id' => 'course_id'])->viaTable('user_courses', ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new Exception("Unsupported", 1);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return 0;
    }

    public function validateAuthKey($authKey)
    {
        return 0;
    }

    public static function findByUsername($username){
        return self::find()->where(['username'=>$username])->one();
    }

    public function validatePassword($password){
        return $this->password == sha1($password);
    }

    public function isAdmin(){
        return $this->is_admin == 1;
    }

    public function isTeacher(){
        return $this->is_teacher == 1;
    }

}
