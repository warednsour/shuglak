<?php

namespace app\controllers;

use app\models\Contact;
use yii\web\Controller;
use Yii;

class ContactController extends Controller
{
    public function actionContact()
    {
        $model = new Contact();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
}
