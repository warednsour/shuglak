<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('main', 'Create Job'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
            'howlong',
            'place',
            'pay',
            'category',
            'link',
            'views',
            'publish',
            'user_id',
            'create_date',
            'expire_date',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="fas fa-eye"></span>', $url, [
                        'title' => 'View',
                    ]);
                },
                'update' => function ($url, $model) {
                    return Html::a('<span class="fas fa-pencil-alt"></span>', $url, [
                        'title' => 'Update',
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a('<span class="fas fa-trash"></span>', $url, [
                        'title' => 'Delete',
                        'data' => [
                            'method' => 'post',
                            'confirm' =>'Are you sure you want to delete this item?',
                        ]
                    ]);
                },
            ],],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
