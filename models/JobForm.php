<?php


namespace app\models;


use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class JobForm extends ActiveRecord
{
    /**
     * This is the model class for table "contact".
     *
     * @property int $id
     * @property string|null $title
     * @property string|null $description
     * @property string|null $howlong;
     * @property string|null $place;
     * @property int|null $pay;
     * @property string|null $category;
     * @property link|null $link;
     */


    public function rules() {
        return [
            [['title','description','howlong', 'place', 'pay','category'] , 'required'],
              [['title','description','howlong','place','category','link'], 'string' , 'max' => 250],
              ['pay', 'number'],
        ];
    }

    public function formName()
    {
        return 'job-form';
    }

    public static function tableName()
    {
        return 'joboffer';
    }

    public function attributeLabels()
{
    return [
        'id' => 'id',
        'title' => 'Title',
        'description' => 'Description',
        'howlong' => 'For how long is the job?',
        'place' => 'in which city?',
        'pay' => 'how much are you going to pay?',
        'category' => 'in which category?',
    ]; // TODO: Change the autogenerated stub
}

    public function addLink($link)
    {
       $this->UpdateAttributes(['link' => $link]);
    }

    public function getAuthor()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'user_id'])->alias('author');
    }

}