<?php

namespace app\controllers;

use app\models\Category;
use app\models\Cities;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use dektrium\user\models\User;
use app\models\ContactForm;
use app\models\Job;
use app\controllers\JobController;
use thyseus\message;


class SiteController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

    public function actionIndex()
    {

        $category = Category::find()->all();
        $jobs =  Job::find();
        $count = $jobs->count();
        $city = Cities::find()->all();
        $pagination = new Pagination(['totalCount' => $count]);
        $job = $jobs->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

//     //   $job = new JobController();
//        $data['jobs'] = Job::find()->all();
//        $countData = clone $data['jobs'];
//        $pages = new Pagination(['totalCount' => $countData->count()]);
//        $models = $data['jobs']->offset($pages->offset)
//            ->limit($pages->limit)
//            ->all();
        return $this->render('index',[
            'jobs' => $job,
            'city' => $city,
            'pagination' => $pagination,
            'category' => $category,
        ]);

    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact()) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}
