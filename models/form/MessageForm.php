<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\db\Message;
use app\models\db\Contact;
use app\models\db\User;


/**
 * ContactForm is the model behind the contact form.
 */
class MessageForm extends Model
{
    public $receiver_username;

    public $sender_user_id;
    public $content;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['receiver_username','sender_user_id','content'], 'required'],
            // email has to be a valid email address
            [['receiver_username','content'], 'string'],
            [['sender_user_id'],'integer']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'receiver_username' => 'Username tujuan',
             'sender_user_id' => 'Pengirim',

              'content' => 'Isi',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact()
    {
        $user_contact = User::find()->where(['username'=>$this->receiver_username])->one();

        $contact = Contact::find()->where([
            'user_id' => $this->sender_user_id,
            'contact_user_id' => $user_contact->id
        ])->one();

        if ($contact === null){
            $contact = new Contact;
            $contact->user_id = $this->sender_user_id;
            $contact->contact_user_id = $user_contact->id;
            $contact->save();
        
            
        }
        if ($contact !== null){
            $message = new Message;
            $message->contact_id = $contact->id;
            $message->content = $this->content;
            if ($message->save()){
                return true;
            }
        }
        return false;
    }
}
