<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Bids');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-wrapper">
<div class="bids-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('main', 'Create Bids'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',],

            'id',
            'title',
            'description',
            'paid',
            'job_id',
         //   'user_id',
        //    'create_date',
       //     'status',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
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
</div>