<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dektrium\user\controllers;

use app\models\Bids;
use app\models\Job;
use dektrium\user\Finder;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use MessageBird;

/**
 * ProfileController shows users profiles.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class ProfileController extends Controller
{
    /** @var Finder */
    protected $finder;

    /**
     * @param string           $id
     * @param \yii\base\Module $module
     * @param Finder           $finder
     * @param array            $config
     */
    public function __construct($id, $module, Finder $finder, $config = [])
    {
        $this->finder = $finder;
        parent::__construct($id, $module, $config);
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'actions' => ['index'], 'roles' => ['@']],
                    ['allow' => true, 'actions' => ['show','jobs','bids'], 'roles' => ['?', '@']],
                ],
            ],
        ];
    }


    public function actionJobs($id)
    {
        return $this->render('jobs');
    }

    public function actionBids($id)
    {
        $profile = $this->finder->findProfileById($id);
        return $this->render('bids');
    }
    /**
     * Redirects to current user's profile.
     *
     * @return \yii\web\Response
     */

//    public function actionIndex()
//    {
//        return $this->redirect(['show']);
//    }

    /**
     * Shows user's profile.
     *
     * @param int $id
     *
     * @return \yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionShow($id)
    {
        $profile = $this->finder->findProfileById($id);

//        if ($profile === null) {
//            throw new NotFoundHttpException();
//        }
        $data['bidOfUser'] = $this->getBidsForUser($id);
        
        return $this->render('show', [
            'profile' => $profile,
            'data' => $data

        ]);
    }


    /***
     * 04-23-2020
     * shows the bids that the user applied to
     * to the user who posted the job
     * this is used to change the status of the bid earlair on if the user who posted the job will click on Hire him
     * getBidsForUser() returs an array
    */


    public function getBidsForUser($id)
    {
        $j = Job::find()
            ->where(['user_id'=> \Yii::$app->user->getId()])
            ->all();

        foreach ($j as $job){
            $b = Bids::find()
                ->where(['status' => 0])
                ->andWhere(['user_id'=>$id])
                ->andWhere(['job_id'=>$job])
                ->all();
 //           if($job->id == $b->job_id){
                return $b;
//            }
        }
    }
}
