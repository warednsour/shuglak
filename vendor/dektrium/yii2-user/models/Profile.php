<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dektrium\user\models;

use app\models\Category;
use app\models\Job;
use dektrium\user\traits\ModuleTrait;
use yii\db\ActiveRecord;
use app\models\Cities;
/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string  $name
 * @property string  $company_name
 * @property integer $city
 * @property string  $fav_categories
 * @property string  $telephone_number
 * @property string  $photo
 * @property string  $bio
 * @property User    $user
 * @property string  $public_email
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class Profile extends ActiveRecord
{
    use ModuleTrait;
    /** @var \dektrium\user\Module */
    protected $module;

    /** @inheritdoc */
//    public function init()
//    {
//        $this->module = \Yii::$app->getModule('user');
//    }
    /**
     * Returns integer out of 100 to show the strength of the profile, completed or not
     * @return integer
     */
    public function getProfileStrength()
    {
        $point = 12.5;
        $stringth = 0;
        $profile_name = $this->name;
        $profile_company_name = $this->company_name;
        $profile_photo = $this->photo;
        $profile_bio = $this->bio;
        $profile_email = $this->public_email;
        $profile_telephone_number = $this->telephone_number;
        $profile_city = $this->city;
        $profile_fav_cat = $this->fav_categories;
        
        if($profile_name !== '') {$stringth += $point;}
        if($profile_bio !== '') {$stringth += $point;}
        if($profile_email !== '') {$stringth += $point;}
        if($profile_telephone_number !== ''){$stringth += $point;}
        if($profile_company_name !== ''){$stringth += $point;}
        if($profile_photo !== ''){$stringth += $point;}
        if($profile_fav_cat !== ''){$stringth += $point;}
        if($profile_city !== ''){$stringth += $point;}

        return $stringth;
    }
    /**
     * For the Circyle.css
     * Returns color ( red , dark = yellow , orange , green )
     * @return string
     */
    public function getProfileColorStrength()
    {
      $strength = Profile::getProfileStrength();
      if ($strength >= 0 && $strength <= 35 ){
          return 'red';
      }
      if ($strength > 35 && $strength <= 70){
          return 'yellow';
      }
      if($strength > 70 && $strength <= 99) {
          return  'orange';
      }
      if($strength == 100){
          return  'green';
      }
    }
    /**
     * Returns favorite categories for the input field in the profile.php view for the form
     * @return Array|NULL
     */
    public function getFavoriteCategoriesForInput()
    {
        return explode(',',$this->fav_categories);
    }
    /**
     * Returns avatar url or null if avatar is not set.
     * @param  int $size
     * @return string|null
     */
    public function getAvatarUrl($size = 200)
    {
        if($this->photo !='') {
            return $this->photo . '?s=' . $size;
        } else {
            return '/basic/web/images/users-photos/no-avatar.png'. '?s=' . $size;;
        }
    }
    /**
     * Returns company name of user's profile
     * @return string
     */
    public function getCompanyName()
    {
        if(\Yii::$app->user->id == \Yii::$app->user->getId())
        {
            return $this->company_name ? $this->company_name : $this->company_name = \Yii::t('main', 'Please tell others where do you work or the name of company you own');
        } else {
            return $this->company_name ? $this->company_name : $this->company_name = \Yii::t('main', 'Shughlak');

        }
    }
    /**
     * Returns city of user's profile
     * @return string
     */
    public function getCity()
    {
        if(\Yii::$app->user->id == \Yii::$app->user->getId())
        {

            return $this->city ? Cities::getCityName($this->city) : $this->city = \Yii::t('main', 'Please tell others where is your location');
        } else {
            return $this->city ? $this->city : $this->city = \Yii::t('main', 'Solar system');

        }
    }
    /**
     * Returns bio of user's profile
     * @return string
     */
    public function getBio()
    {
        if(\Yii::$app->user->id == \Yii::$app->user->getId())
        {
            return $this->bio ? $this->bio : $this->bio = \Yii::t('main', 'Please write about yourself');
        } else {
            return $this->bio ? $this->bio : $this->bio = \Yii::t('main', 'User didn\'t write about himself');

        }
    }
    /**
     * @return \yii\db\ActiveQueryInterface
     */

    public function getUser()
    {
        return $this->hasOne($this->module->modelMap['User'], ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'bioString'            => ['bio', 'string'],
            'publicEmailLength'    => ['public_email', 'string', 'max' => 255],
            'telephone'            => ['telephone_number','string', 'max' => 255],
            'cityLength'           => ['city', 'string', 'max' => 255],
//            'preferedCategories'   => ['fav_categories', 'string', 'max' => 255],
            'companyName'          => ['company_name', 'string'],
            'nameLength'           => ['name', 'string', 'max' => 255],
            'photo'                => ['photo','file']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bio'            => \Yii::t('user', 'Bio'),
            'public_email'   => \Yii::t('user', 'Email'),
            'telephone_number'  => \Yii::t('user', 'Telephone Number'),
            'city'           => \Yii::t('user', 'city'),
            'fav_categories'           => \Yii::t('user', 'Categories'),
            'company_name'       => \Yii::t('user', 'Compane Name'),
            'name'        => \Yii::t('user', 'Name'),
        ];
    }

    public static function tableName()
    {
        return '{{%profile}}';
    }






















































    /**
     * Validates the timezone attribute.
     * Adds an error when the specified time zone doesn't exist.
     * @param string $attribute the attribute being validated
     * @param array $params values for the placeholders in the error message
     */
//    public function validateTimeZone($attribute, $params)
//    {
//        if (!in_array($this->$attribute, timezone_identifiers_list())) {
//            $this->addError($attribute, \Yii::t('user', 'Time zone is not valid'));
//        }
//    }

    /**
     * Get the user's time zone.
     * Defaults to the application timezone if not specified by the user.
     * @return \DateTimeZone
     */
//    public function getTimeZone()
////    {
////        try {
////            return new \DateTimeZone($this->timezone);
////        } catch (\Exception $e) {
////            // Default to application time zone if the user hasn't set their time zone
////            return new \DateTimeZone(\Yii::$app->timeZone);
////        }
////    }

    /**
     * Set the user's time zone.
     * @param \DateTimeZone $timezone the timezone to save to the user's profile
     */
//    public function setTimeZone(\DateTimeZone $timeZone)
//    {
//        $this->setAttribute('timezone', $timeZone->getName());
//    }

    /**
     * Converts DateTime to user's local time
     * @param \DateTime the datetime to convert
     * @return \DateTime
     */
//     public function toLocalTime(\DateTime $dateTime = null)
//    {
//        if ($dateTime === null) {
//            $dateTime = new \DateTime();
//        }
//
//        return $dateTime->setTimezone($this->getTimeZone());
//    }

    /**
     * @inheritdoc
     */
//    public function beforeSave($insert)
//    {
//        if ($this->isAttributeChanged('gravatar_email')) {
//            $this->setAttribute('gravatar_id', md5(strtolower(trim($this->getAttribute('gravatar_email')))));
//        }
//
//        return parent::beforeSave($insert);
//    }

    /**
     * @inheritdoc
     */


}
