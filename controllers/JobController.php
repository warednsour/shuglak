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
use yii\web\View;


class JobController extends Controller
{

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
     * @return view showjob
     */

    public function actionShowjob($link)
    {

        /*
         * Job offer
         * */

        //Find the job to show it, we find the job according to the link
        //All the links are unique, don't worry.
        $data['model'] = Job::find()->where(['link'=> $link ])->one();
        //Update views on the job +1 for each visit to page.
        $post = Job::find()
            ->where(['id' => $data['model']['id']])
            ->one();
        $post->updateCounters(['views' => 1]);
        //The Job ID
        $id = $data['model']->id;
        //Get city name from cities model, the city in the job are saved as an id of the city
        //The getCityName will receive the id and return the city as name according to the app language.
        $city = Cities::getCityName($data['model']->place);
        //Declare city name
        $data['model']->place= $city;
        //Get Category name from Category model, the category in the job is saved as a id of the city
        //The getCategoryName will receive the id and return the category name according to the app language.
        $category = Category::getCategoryName($data['model']->category);
        //Declare category name
         $data['model']->category = $category;

         /*
          * Employer
          * */
        //Getting the Employer the user who wrote the job offer throw Job model where the user id is the user_id in Job offer
        //Declare the employer
        $data['employeer'] = $data['model']->employeer;
        //Get the employer create-date of account which is in time , converting to readable date.
        $user = User::findOne($data['model']->user_id);
        $data['employeerCreateDate'] = (date('Y-m-d',$user->created_at));
        //Employer Verification
        //If the email is verified
        $data['employeerEmailVer'] = $user->confirmed_at;

        /*
         * Bids on this job
         * */

        //Get the bids on this job using the job_id each bid has a job_id, The bids are showed to all the users
        $data['bids'] = Bids::getBids($id);

        /*
         * User showing this job
         * */

        //Check if current user all ready applied for this Job
        $data['bidStatus'] = Bids::userAllReadyAppliedForJob($id);
        if(is_object($data['bidStatus'])) {
            $data['currentUserMadeBid'] = true;
        }
        //Check if current user who posted the job is the employeer, can't send a message for him self.
        if($data['model']->user_id == Yii::$app->user->getId()) {
            $data['userIsEmployeer'] = true;
        }
        //Check if current user is hired for this job so can send a message to the employeer
        if(!Yii::$app->user->isGuest &&  $data['bidStatus']->status == 1 && Yii::$app->user->identity){
            $data['currentUserHiredForJob'] = true;
        }

        $data['review'] = new Review;

        $data['bid'] = new Bids;

        $data['message'] = new Message;

        return $this->render('showjob', compact(['data','bidders']));

    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */

}