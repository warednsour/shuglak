<?php


namespace app\models;


use DateInterval;
use DateTime;
use yii\db\ActiveRecord;

class Verify extends ActiveRecord
{
//    /**
//     * @var string the original name of the file being uploaded
//     */
//    private $user_id;
//    /**
//     * @var string the path of the uploaded file on the server.
//     * Note, this is a temporary file which will be automatically deleted by PHP
//     * after the current request is processed.
//     */
//    private $name_ar;
//    /**
//     * @var string the MIME-type of the uploaded file (such as "image/gif").
//     * Since this MIME type is not checked on the server-side, do not take this value for granted.
//     * Instead, use [[\yii\helpers\FileHelper::getMimeType()]] to determine the exact MIME type.
//     */
//    public $name_en;
//    /**
//     * @var int the actual size of the uploaded file in bytes
//     */
//    public $sex;
//    /**
//     * @var int an error code describing the status of this file uploading.
//     * @see https://secure.php.net/manual/en/features.file-upload.errors.php
//     */
//    public $error;
//
//    /**
//     * @var resource a temporary uploaded stream resource used within PUT and PATCH request.
//     */
//    private $_tempResource;
//    private static $_files;
//
//
//    /**
//     * UploadedFile constructor.
//     *
//     * @param array $config name-value pairs that will be used to initialize the object properties
//     */


    public function rules()
    {
        // today
        $date = new DateTime();
        // 18 years ago
        $date->sub(new DateInterval('P18Y'));
        // maximum birthday
        $max = $date->format('Y-m-d');

        return [
            [['name_ar','name_en','sex','mother_name','reg_num_place','place_issue','place_residence','city_of_birth'] , 'string'],
            [['national_number'],'string', 'max' => 10],
            [['user_id'],'integer'],
            [['status'],'integer', 'max' => 2],
            [['user_agree'], 'integer','max' =>1],
            [['birth_date'],'date','format' => 'php:Y-m-d','max'=> $max , 'tooBig' => 'Must be 18 years old'],
            [['name_ar','name_en','sex','mother_name','reg_num_place','place_issue','place_residence','national_number','user_agree','birth_date','city_of_birth'], 'required'],
            [['files'],'file','skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg' , 'maxFiles' => 2],
        ]; // TODO: Change the autogenerated stub
    }

    public static function tableName()
    {
        return 'verify_user'; // TODO: Change the autogenerated stub
    }

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name_ar' => \Yii::t('main','Name in Arabic'),
            'name_en' => \Yii::t('main','Name in English'),
            'sex' => \Yii::t('main','Sex'),
            'mother_name' => \Yii::t('main','Mother Name'),
            'reg_num_place' => \Yii::t('main','Registration number and place'),
            'place_issue' => \Yii::t('main','Place of issue'),
            'place_residence' => \Yii::t('main','Place of residence'),
            'city_of_birth' => \Yii::t('main','City of birth'),
            'national_number' => \Yii::t('main','National number'),
            'birth_date' => \Yii::t('main','Birth date'),
            'files' => \Yii::t('main','Photos of Id'),
        ]; // TODO: Change the autogenerated stub
    }
}