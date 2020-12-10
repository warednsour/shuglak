<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends ActiveRecord
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    public $id;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'string']
            // name, email, subject and body are required
         //   [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
       //     ['email', 'email'],
            // verifyCode needs to be entered correctly
          //  ['verifyCode', 'captcha'],
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
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact()
    {
        if ($this->validate()) {
            $contact = new ContactForm();
            $this->name = $this->name;
            $this->subject = $this->subject;
            $this->body = $this->body;
            $this->email = $this->email;
            if ($contact->save(false)){
            }
            VarDumper::dump($contact->getErrors());
        };
        return false;
    }
    public static function tableName()
    {
        return /** @lang text */ 'contact';
    }
}
