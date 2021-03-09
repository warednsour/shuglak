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

use app\models\Job;
use dektrium\user\traits\ModuleTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string  $name
 * @property string  $company_name
 * @property string  $gravatar_email
 * @property string  $gravatar_id
 * @property string  $location
 *  @property string $fav_categories
 * @property string  $website
 * @property string  $bio
 * @property string  $timezone
 * @property User    $user
 *
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
     * Returns avatar url or null if avatar is not set.
     * @param  int $size
     * @return string|null
     */
//    public function getAvatarUrl($size = 200)
//    {
//        return '//gravatar.com/avatar/' . $this->gravatar_id . '?s=' . $size;
//    }

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
