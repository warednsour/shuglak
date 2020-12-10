<?php

namespace app\modules\administrator\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{


    public $layout = '@app/modules/administrator/views/layouts/main';


    public function actionIndex()
    {
       return $this->render('index');
    }

}