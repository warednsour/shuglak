<?php


namespace app\models;


use yii\db\ActiveRecord;

class Bids extends ActiveRecord
{


    /**
     * @property integer $status
     * @property string  $title
     * @property string  $description
     * @property integer $paid
     * @property integer $job_id
     * @property integer $user_id
     * @property datetime $create_date
     */
    public static function tableName()
    {
        return 'bids'; // TODO: Change the autogenerated stub
    }

    public function rules()
    {
        return [
           [['title','description'] , 'string'],
            [['paid','job_id','user_id'],'integer', 'message' => \Yii::t('main','How much are you going to get paid must be a number')],
            [['paid','title','description'], 'required']
        ]; // TODO: Change the autogenerated stub
    }
    public function getJobonbid()
    {
        return $this->hasMany(Job::className(),['id'=>'job_id']);
    }

    public function getBids($job_id)
    {
     return $bids =  Bids::find()
            ->where(['job_id' => $job_id])
            ->all();
    }

    public function userAllReadyAppliedForJob($job_id)
    {
        return Bids::find()
            ->where(['job_id'=> $job_id])
            ->andWhere(['user_id'=> \Yii::$app->user->getId()])
            ->one();
    }

    public function getBidsCountForUser($user_id)
    {
        $bids = Bids::find()
            ->where(['user_id' => $user_id])
            ->all();
        return count($bids);
    }

    //Returns the number of bids the user made and done successfully
    public function getBidsDoneCountForUser($user_id)
    {
        $bids = Bids::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['status' => 2])
            ->all();

        return count($bids);
    }

    //Returns the bids for current job
    public function getBidsForJob($job_id)
    {
        return $bids = Bids::find()
            ->where(['job_id'=>$job_id])
            ->all();
    }

    public function getBidsForUser($user_id)
    {
        return $bids = Bids::find()
            ->where(['user_id'=>$user_id])
            ->all();
    }
}