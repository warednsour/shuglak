<?php

namespace app\modules\administrator;

use Yii;
use yii\db\ActiveQueryInterface;
use Yii\db\BaseActiveRecord;
use yii\filters\AccessControl;
use dektrium\user\models\User;


class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\administrator\controllers';

    /**
     * {@inheritdoc}
     */

    public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                       'roles' => ['admin','editor'],
                    ]
                ],
            ],
        ];
    }



//    public function init()
//
//    {
//        \Yii::$app->view->theme = new \yii\base\Theme([
//
//            'pathMap' => ['@app/views' => '@vendor/almasaeed2010/adminlte/starter'],
//
//        ]);
//
//     //   $message = \app\models\Support::find()->where(['status'=>0])->count();
//     //   $comments = \app\models\ReviewComment::find()->where(['status'=>0])->count();
//
//        parent::init();
//
//    }

//    public static function getUserList()
//    {
//        $parents = User::find()
//            ->select(['id', 'username'])
//            ->distinct(true)
//            ->all();
//
//        return ArrayHelper::map($parents, 'id', 'name');
//    }
    /**
     * @inheritDoc
     */
    public static function primaryKey()
    {
        // TODO: Implement primaryKey() method.
    }

    /**
     * @inheritDoc
     */
    public static function find()
    {
        // TODO: Implement find() method.
    }

    /**
     * @inheritDoc
     */
    public function insert($runValidation = true, $attributes = null)
    {
        // TODO: Implement insert() method.
    }

    /**
     * @inheritDoc
     */
    public static function getDb()
    {
        // TODO: Implement getDb() method.
    }
}