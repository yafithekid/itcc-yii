<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\db\Contact;
use app\models\db\User;


/**
 * ContactForm is the model behind the contact form.
 */
class UserContactForm extends Model
{
    public $username;
    public $current_user_id;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['username','current_user_id'], 'required'],
            // email has to be a valid email address
            ['username', 'string'],
            // verifyCode needs to be entered correctly
            ['current_user_id', 'integer'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function save()
    {
        $user_contact = User::find()->where(['username' => $this->username])->one();
        if ($user_contact === null){
            $this->addError('username','Username not found');
        } else {
            $contact = Contact::find()
            ->where(['user_id'=>$this->current_user_id,'contact_user_id'=>$user_contact->id])->one();
            if ($contact === null){
                $contact = new Contact;
                
                $contact->user_id = $this->current_user_id;
                $contact->contact_user_id = $user_contact->id;
                return $contact->save();
            } else {
                return true;
            }
        }

        
    }
}
