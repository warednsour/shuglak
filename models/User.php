<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName() {
        return '{{user}}';
    }

    public function rules() {
        return [
            [['username', 'email','password_hash'], 'required'],
            [['unconfirmed_email','registration_ip','auth_key','password_hash'],'string'],
            [['confirmed_at','blocked_at','created_at','updated_at'],'integer'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
