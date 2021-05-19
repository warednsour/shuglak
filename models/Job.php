<?php


namespace app\models;


use DateTime;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Job extends ActiveRecord
{
    /**
     * This is the model class for table "joboffer".
     *@property TYPE_DATETIME $date_expire
     * @property int $id
     * @property string|null $title
     * @property string|null $description
     * @property string|null $how_long;
     * @property string|null $place;
     * @property int|null $pay;
     * @property string|null $category;
     *  @property string|null $link;
     * @property string|null $file;
     */

    public static function tableName()
    {
        return 'joboffer';
    }

    public function rules() {
        return [
            ['title', 'required' , 'message'=> \Yii::t('main','Title cant be empty')],
            [['description','howlong', 'place', 'pay','category','expire_date'],'required'],
            [['title','description','howlong','place','category','link'], 'string' , 'max' => 255],
//            [['expire_date'], 'time'],
//            [['expire_date'], 'validateExpireDate'],
     //       [['expire_date'], 'default', 'value'=>date('yyyy-mm-dd hh:i:ss')],
            ['pay', 'number'],
            [['file'],'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, pdf' , 'maxFiles' => 4],
        ];
    }

//    public function validateExpireDate($attribute,$params){
//        $date = new \DateTime();
//        date_sub($date, date_interval_create_from_date_string('1 day'));
//        $minAgeDate = date_format($date, 'Y-m-d');
//        if (strtotime($this->$attribute) < $minAgeDate) {
//            $this->addError($attribute, 'Date can not be in the past!');
//      }
//    }
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'title' => \Yii::t('main','Title'),
            'description' => \Yii::t('main','Description'),
            'howlong' => \Yii::t('main','For how long is the job?'),
            'place' => \Yii::t('main','City'),
            'pay' => \Yii::t('main','What is your estimated budget?'),
            'category' => \Yii::t('main','Category'),
            'expire_date' => \Yii::t('main','For how long this job is valid?')
        ]; // TODO: Change the autogenerated stub
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getJobsForUser()
    {
        return $this->hasMany(User::className(),['user_id'=>'id'])->alias('user');
    }

    public function getBidonjob()
    {
        return $this->hasMany(Bids::className(),['job_id'=>'id']);
    }

    public function findMatchTitle($title)
    {
        $job = Job::find()
            ->where(['title' => $title])
            ->all();
        return $job;
    }

    //This function will return the user who created the job
    //Creating the connection bettween the user and the Job offer.
    //Each user can post many Job offers but Job offer has one user who have created it.

    public function getUser()
    {
        return $this->hasOne(\dektrium\user\models\User::className(),['id'=> 'user_id']);
    }

    public function getEmployeer()
    {
        return $this->hasOne(\dektrium\user\models\Profile::className(), ['user_id' => 'user_id']);
    }

    //Count all the jobs for current user
    public function getJobCountForUser($user_id)
    {
        return count(Job::getJobs($user_id));
    }

    //Get all the jobs for current user
    public function getJobs($user_id)
    {
        return $jobs = Job::find()
            ->where(['user_id' => $user_id])
            ->all();
    }

    //Get Job name
    public function getJobName($job_id)
    {
        $job = Job::findOne($job_id);
        return $job->title ;
    }


    //Get job link
    public function getJobLink($job_id)

    {
        $job = Job::findOne($job_id);
        return $job->link;
    }
}