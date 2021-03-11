<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title_ar
 * @property string $title_en
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_ar', 'title_en'], 'required'],
            [['title_ar', 'title_en'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_ar' => 'Title Ar',
            'title_en' => 'Title En',
        ];
    }
    public function getCategoryName($categoryId)
    {
        $$category =   Category::find()
            ->where(['id' => $categoryId])
            ->one();
        if(\Yii::$app->language == 'en') {
            return $$category->title_en;
        } elseif(\Yii::$app->language == 'ar') {
            return  $$category->title_ar;
        }
    }
}
