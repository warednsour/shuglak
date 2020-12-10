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
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;


class AjaxController extends SiteController
{

//    public function beforeAction($actionReview)
//    {
//
//           $this->enableCsrfValidation = false;
//
//    }

    public function actionAddbid()
    {

       $result['result'] = false;
       if(Yii::$app->request->isAjax && Yii::$app->user->identity) {
           $request = Yii::$app->request;
           // job_id => we are getting it null this is why this line is not working
//           if($request->post('job_id')> 0 && $request->post('description'))
//           {
//              //  $bid = Bids::find()->where(['id' => $request->post('job_id')]);
//               // if($bid) {
//
//                }
              //  var_dump(Yii::$app->request->post("Bids")['user_id']);
                $bid = new Bids([
                    'user_id' => Yii::$app->request->post("Bids")['user_id'],
                    'job_id' => Yii::$app->request->post("Bids")['job_id'],
                    'title' => Yii::$app->request->post("Bids")['title'],
                    'description' => Yii::$app->request->post("Bids")['description'],
                    'paid' => Yii::$app->request->post("Bids")['paid'],
                ]);

               $bid->save(false);
            //    $this->refresh();
               $result['result'] = true;
           }
//      }
      json_encode($result);
   }

   public function actionMessage()
   {

       $result['result'] = false;
       if(Yii::$app->request->isAjax && Yii::$app->user->identity) {
           $request = Yii::$app->request;
          if($request->post('Message')['receiver_id'] > 0 && $request->post('Message')['text']){
//              if($request->post('Message')['sender_id'] == Yii::$app->user->getId()){
               $message = new Message([
                   'text' => $request->post('Message')['text'],
                   'title' => $request->post('Message')['title'],
                   'receiver_id' => $request->post('Message')['receiver_id'],
                   'sender_id' => $request->post('Message')['sender_id'],

               ]);

               $message->save();
               $result['result'] = true;
              Yii::$app->session->setFlash('MessageSuccess');
              }
//         }
       }
       json_encode($result);
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
                ->where(['like','title',$title . '%' , false])
                ->orWhere(['like','description',$title . '%', false])
                ->all();

        } else if (isset($place)) {


                $job = $jobs
                    ->limit($increment)
                    ->where(['place' => $place])
                    ->all();


        } else {
            $job = $jobs
                ->limit($increment)
                ->all();
        }


//        $job = $jobs->offset($pagination->offset)
//        ->limit($pagination->limit)
//        ->all();
        if($job) {
            foreach ($job as $j) {

                $outPut .=    '<div class="card col-md-3" style="width: 18rem;">
            <div id = "loading"></div>
            <div class="card-body">
                <h5 class="card-title">' . $j->title . '</h5>
            <p class="card-text text-muted">' . $j->description . '</p>
            <p class="card-text text-muted">' . $j->place . '</p>
            <p class="card-text text-muted">' . $j->pay . '</p>
            <a href="'. Url::to(['job/showjob', 'link' => $j->link]) .'" class="btn btn-primary">Bid Now!</a>
            </div>
            </div>';

            }

            $outPut .= ' <button id = "loadMore" class="btn-primary btn-block">
                Load More
            </button>';
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