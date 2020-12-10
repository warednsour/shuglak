<?php


namespace app\models;


use yii\db\ActiveRecord;

class Review   extends ActiveRecord
{
    public static function tableName()
    {
        return 'review'; // TODO: Change the autogenerated stub
    }

    public function rules()
    {
        return [
            [['review_content','review_title'], 'string'],
       //     [['review_content','review_title'], 'required'],
            [['reviewer_id','reviewed_id'],'integer'],
 //           [['rating'],'number'],
        ]; // TODO: Change the autogenerated stub
    }
}
