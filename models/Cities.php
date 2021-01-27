<?php


namespace app\models;


use yii\db\ActiveRecord;

class cities extends ActiveRecord
{
    /**
     * This is the model class for table "contact".
     *
     * @property int $id
     * @property string|null $city
     */
    public static function tableName()
    {
        return 'cities';
    }
    public function  getCityName($cityId)
    {
        $city =    Cities::find()
            ->where(['id' => $cityId])
            ->one();
        if(\Yii::$app->language == 'en') {

            return $city->city_en;
        } elseif(\Yii::$app->language == 'ar') {
            return  $city->city_ar;
        }
    }
}