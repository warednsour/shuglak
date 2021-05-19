<?php
/**
 * Created by PhpStorm.
 * User: villa
 * Date: 22.11.2018
 * Time: 1:56
 */

namespace app\models;


use dektrium\user\models\User;
use yii\db\ActiveRecord;

class Profile extends ActiveRecord
{
    /**
     * This is the model class for table "account".
     *
     * @property integer $user_id
     * @property string  $name
     * @property string  $public_email
     * @property string  $gravatar_email
     * @property string  $gravatar_id
     * @property string  $location
     * @property string  $website
     * @property string  $bio
     * @property string  $timezone
     * @property User    $user
     *
     * @author Dmitry Erofeev <dmeroff@gmail.com
     */

    public static function tableName() {
        return '{{account}}';
    }

    public function rules() {
        return [
            [['name', 'public_email','location','website','bio','avatar'], 'string'],
        ];
    }
    public function getAuthorname()
    {
        if(!($this->name === null))
        {
            return $this->name = 'New User';
        } else return $this->name;
    }



}