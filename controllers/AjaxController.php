<?php


namespace app\controllers;

use app\models\Bids;
use app\models\cities;
use app\models\Job;
use app\models\Message;
use app\models\Review;
use dektrium\user\models\User;
use Yii;
use yii\data\Pagination;
use yii\db\conditions\LikeCondition;
use yii\db\Query;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;


class AjaxController extends SiteController
{

    public $enableCsrfValidation = false;
    //Never to Change
    CONST SPECIAL_MESSAGE_REGEX = '!@#$%^&*(-+)2021SHUGHLAK1202(+-)*&^%$#@!';

//    public function beforeAction($action)
//    {
//        return json_encode('ward'); // TODO: Change the autogenerated stub
//    }



    public function actions()
    {
        $userId = Yii::$app->user->id;
        if (Yii::$app->user->identity) {
            return [
                'change-avatar' => [
                    'class' => 'budyaga\cropper\actions\UploadAction',
                    'url' =>  Yii::getAlias("@web").'/images/users-photos/' . Yii::$app->user->identity->getId(),
                    'type' => 'user_avatar',
                    'path' => '@app/web/images/users-photos/' . Yii::$app->user->identity->getId(),
                ]
            ];
        }
    }

    /*
     * Ajax request
     * should have these parameters
     * $_POST
     *           [    'job_id' => '220'
     *               'user_id' => '9'
     *               'title' => 'i really need this job'
     *               'description' => 'weqweqwe'
     *              'paid' => '123' // number
     *           ]
     * */
    public function actionPlaceabid()
    {
        $result['result'] = false;
       if(Yii::$app->request->isAjax && Yii::$app->user->identity) {
           $model = new Bids;
           $request = Yii::$app->request;
           $post = $request->post();
           $job_id = $post['Bids']['job_id'];
            //Check if user all ready placed a bid on this job.
           // User can't bid twice and he will not be able to, but for double check
           $bidIsUniqe =  Bids::userAllReadyAppliedForJob($job_id);
           if(is_object($bidIsUniqe)) {
               return false;
           }

           if($model->load($request->post()))
               $model->save(false);
               $result['result'] = true;
           }
      json_encode($result);
   }

   public function actionMessage()
   {
       //Check if the user is not a guest and the request is an Ajax request
       if(!Yii::$app->user->isGuest && Yii::$app->request->isAjax) {

           $result['result'] = false;

           $model = new Message;
           if ($model->load(Yii::$app->request->post())) {
           /* The user who is receiving the message (receiver_id)  $receiver
            * The user who is sending the message (sender_id)  $sender
            * Check if it's a number we are receiving and since we are receiving
            * a string we convert it to integer
            */
               $model->save();
               $result['result'] = true;
               json_encode($result);
                 }
           }
       }

   public function actionBidstatusaccepted($id)
   {

       $result['result'] = false;
       if(Yii::$app->request->isAjax && Yii::$app->user->identity){
           $request = Yii::$app->request;

            $bid = Bids::find()
                ->where(['id'=> $id])
                ->one();
           $bid->updateAttributes(['status' => 1]);
            $bid->save(false);
           $result['result'] = true;
       }
       json_encode($result);
   }

    public function actionBidstatusdone($id)
    {

        $result['result'] = false;
        if(Yii::$app->request->isAjax && Yii::$app->user->identity){
            $request = Yii::$app->request;

            $bid = Bids::find()
                ->where(['id'=> $id])
                ->one();
            $bid->updateAttributes(['status' => 2]);
            $bid->save(false);
            $result['result'] = true;
        }
        json_encode($result);
    }

    public function actionBidstatusnot($id)
    {

        $result['result'] = false;
        if(Yii::$app->request->isAjax && Yii::$app->user->identity){
            $request = Yii::$app->request;

            $bid = Bids::find()
                ->where(['id'=> $id])
                ->one();
            $bid->updateAttributes(['status' => 3]);
            $bid->save(false);
            $result['result'] = true;
        }
        json_encode($result);
    }

    public function actionReview()
    {

        $result['result'] = false;
        if(Yii::$app->request->isAjax && Yii::$app->user->identity) {
            $request = Yii::$app->request;
          //  if($request->post('Review')['receiver_id'] > 0 && $request->post('Review')['text']){
//              if($request->post('Message')['sender_id'] == Yii::$app->user->getId()){
                $review = new Review([
                    'review_title' => $request->post('Review')['review_title'],
                    'review_content' => $request->post('Review')['review_content'],
                    'reviewed_id' => $request->post('Review')['reviewed_id'],
                    'reviewer_id' => $request->post('Review')['reviewer_id'],
                    'rating' => $request->post('Review')['rating'],
                    'job_id' => $request->post('Review')['job_id']
                ]);

                $review->save(false);
                $result['result'] = true;
                Yii::$app->session->setFlash('ReviewSuccess');
           }
//         }
     //   }
        json_encode($result);
    }

    public function actionFilter($page)
    {
        $request = Yii::$app->request;

        if($request->post('title')) {
            $title = $request->post('title');
        }

        if($request->post('description')){
            $description = $request->post('description');
        }

        if($request->post('place')){

            $place = $request->post('place');
//            extract($place, EXTR_PREFIX_ALL,'p');

        }

        if($request->post('pay')) {
            $pay = $request->post('pay');
        }


        $city = Cities::find()->all();

        $outPut = '';

        $jobs = Job::find();
        $count = $jobs->count();
        $pagination = new Pagination(['totalCount' => $count]);


        $increment = $pagination->limit + ($page * 5);

        if(isset($title)){

            $job = $jobs
                ->limit($increment)
                ->orderBy(["joboffer.create_date"=> SORT_DESC])
                ->where(['like','title',$title . '%' , false])
                ->orWhere(['like','description',$title . '%', false])
                ->all();

        } else if (isset($place)) {


                $job = $jobs
                    ->limit($increment)
                    ->orderBy(["joboffer.create_date"=> SORT_DESC])
                    ->where(['place' => $place])
                    ->all();


        } else {
            $job = $jobs
                ->limit($increment)
                ->orderBy(["joboffer.create_date"=> SORT_DESC])
                ->all();
        }


//        $job = $jobs->offset($pagination->offset)
//        ->limit($pagination->limit)
//        ->all();
        if($job) {
            foreach ($job as $j) {

                $outPut .=    '<div class="job-offer-main">
            
            
                <h5 class="card-title">' . $j->title . '</h5>
            <p class="card-text text-muted">' . $j->description . '</p>
            <p class="card-text text-muted">' . $j->place . '</p>
            <p class="card-text text-muted">' . $j->pay . '</p>
            <a href="'. Url::to(['job/showjob', 'link' => $j->link]) .'" class="btn-yellow">Bid Now!</a></div>
          
           ';

            }

            $outPut .= '';
        } else {
            $outPut = 'No results found';
        }

//        $count = $jobs->count();
//        $pagination = new Pagination(['totalCount' => $count]);
//        $job = $jobs->offset($pagination->offset)
//            ->limit($pagination->limit);
////            ->andFilterWhere(['like','title', $request->post()['title']])->all();

//     //   $job = new JobController();
//        $data['jobs'] = Job::find()->all();
//        $countData = clone $data['jobs'];
//        $pages = new Pagination(['totalCount' => $countData->count()]);
//        $models = $data['jobs']->offset($pages->offset)
//            ->limit($pages->limit)
//            ->all();
        $result['result'] = true;
        json_encode($result);
//        return $this->render('index',[
//            'jobs' => $job,
//            'pagination' => $pagination,
//        ]);
//        $outPut .= '<h1>'. $increment .'</h1>';

        return $outPut;
    }

}