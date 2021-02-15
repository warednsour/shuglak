<?php


namespace app\controllers;

use app\models\Category;
use app\models\cities;
use app\models\Review;
use app\models\Message;
use app\models\Bids;
use app\models\JobForm;
use app\models\Job;
use dektrium\user\models\Profile;
use dektrium\user\models\User;
use yii\web\Controller;
use Yii;


class JobController extends Controller
{

//    public function actionIndex()
//    {
//        $model = new JobForm();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->refresh();
//        }
//        return $this->render('index', [
//            'model' => $model,
//        ]);
//    }
//
//    /**
//     * @return string
//     */
    public function actionAddjob()
    {
         $this->layout = 'addjob/main';
        if(!Yii::$app->user->isGuest){
            $data['model'] = new Job();
            $data['cities'] = Cities::find()->all();
            $data['categories'] = Category::find()->all();
            return $this->render('addjob', compact('data'));

        } else {
            $this->goHome();
        }

    }

    /**
     * @param $link
     * @return string
     */

    public function actionShowjob($link)
    {


        $data['model'] = Job::find()->where(['link'=> $link ])->one();
        $id = $data['model']->id;

        // using the getUser() function accessing it like this $data['model']->user;

        //Get city name
        $city = Cities::getCityName($data['model']->place);
        //Declare city name
        $data['model']->place= $city;
        //Get Category name
        $category = Category::getCategoryName($data['model']->category);
        //Declare category name
         $data['model']->category = $category;
        //Getting the Employer the user who wrote the job offer throw Job model where the user id is the user_id in Job offer
        //Get the employer
        $data['employeer'] = $data['model']->employeer;
        //Get the employer creating date of account which is in time , converting to readable date.
        $user = User::findOne($data['model']->user_id);
        $data['employeerCreateDate'] = (date('Y-m-d',$user->created_at));


        //Employer Verification
        //If the email is verified
        $data['employeerEmailVer'] = $user->confirmed_at;


        //Employer username - use it
        $data['bidStatusHire'] = Bids::find()
            ->where(['job_id'=>$id])
            ->andWhere(['status'=> 0])
            ->one();

        $data['bidders'] = Bids::find()
            ->where(['job_id' => $id])
            ->all();

        $data['review'] = new Review();

        $data['bid'] = new Bids();

        $data['message'] = new Message;

        $post = Job::find()
            ->where(['id' => $data['model']['id']])
            ->one();
        $post->updateCounters(['views' => 1]);

             $job = Job::find()
            ->where(['user_id' => Yii::$app->user->id])->one();


             $data['bidStatus'] = Bids::find()
            ->where(['job_id'=> $id])
            ->andWhere(['user_id'=> Yii::$app->user->getId()])
            ->one();


        if($data['bidStatusHire']->status == 1 ){   // if at least one is hired for this job it no longer will be shown!
            $this->goHome();
        } else {
            return $this->render('showjob', compact(['data','bidders']));
        }
    }
    /**
     * @return array|\yii\db\ActiveRecord[]
     */


    public function getJobs()
    {
        return Job::find()->all();

    }
    public function getJobslink($link)
    {
        return Job::find()
            ->Where(['link' => $link])
            ->one();
    }


}