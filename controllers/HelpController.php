<?php


namespace app\controllers;


use yii\web\Controller;
use app\models\Help;
use Yii;
class HelpController extends Controller
{
    public function actionIndex() {

        $model = new Help();
        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('helpformsubmitted');
            return $this->refresh();
        }
        return  $this->render('index',
            [ 'model'=> $model
              ]);
    }
}