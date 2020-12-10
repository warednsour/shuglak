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

}