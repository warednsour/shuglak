<?php

use kartik\rating\StarRating;

$language = \Yii::$app->language;

?>

<div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="account-info">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto" style="text-align: center !important;">
                    <div class="profile">
                        <div class="edit">
                            <a href="<?=\yii\helpers\Url::toRoute(['user/settings/profile'])?>">
                                <button class="btn btn-fab btn-primary btn-round" rel="tooltip" title="" data-original-title="Edit your profile">
                                    <i class="fas fa-user-edit"></i>
                                </button>
                            </a>
                        </div>
                        <div class="avatar">
                            <img src="<?= $data['profile']->getAvatarUrl(200)?>" alt="" class ="account-img">
                        </div>
                        <div class="account-name">
                            <h3 class="account-title"><?=$data['profile']->name ? $data['profile']->name : Yii::$app->user->identity->username ?></h3>
                            <h6><?=$data['profile']->getCompanyName()?></h6>
                            <h6><?=$data['profile']->getCity()?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="account-bio text-center">
                <p><?=$data['profile']->getBio()?>
                </p>
            </div>
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="justify-content: center;">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-work-tab" data-toggle="pill" href="#pills-work" role="tab" aria-controls="pills-home" aria-selected="true">Work</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-reviews" aria-selected="false">reviews</a>
                        </li>
                    </ul>


                </div>
            </div>
            <div class="row">
                <div class="tab-content tab-space" id="pills-tabContent" >
                    <div class="tab-pane fade show active work" id="pills-work" role="tabpanel" aria-labelledby="pills-work-tab">
                        <div class="row">
                            <div class="col-md-7 ml-auto mr-auto ">
                                <h4 class="account-title">Latest Work</h4>
                                <div class ="row latest-work">
                                    <?php if($data['latestWork'] !== false){
                                        foreach ($data['latestWork'] as $work){?>
                                    <div class="col-md-6">
                                        <div class="card card-background" style='background-image: url("<?//= $work?>")'>
                                            <img src="<?=$work?>" alt="">
                                        <div class="card-body">
                                            do you like it?
                                        </div>
                                    </div>
                                </div>
                                <?php }
                                } ?>


<!--                                <div class="col-md-6">-->
<!--                                    <div class="card card-background" style=' background-image: url('--><?php //echo "ward"?><!--')'>-->
<!--                                    <div class="card-body">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <div class="card card-background" style=' background-image: url('--><?php //echo "ward"?><!--')'>-->
<!--                                <div class="card-body">-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-6">-->
<!--                        <div class="card card-background" style=' background-image: url('--><?php //echo "ward"?><!--')'>-->
<!--                        <div class="card-body">-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                </div>
            </div>
            <div class="col-md-2 mr-auto ml-auto stats">
                <h4 class="account-title"><?=Yii::t('main','Status')?></h4>
                <ul class="list-unstyled">
                    <li><b><?=$data['jobsOffered']?></b> <?= Yii::t('main','Jobs offered')?></li>
                    <li><b><?= $data['bidsMade']?></b> <?= Yii::t('main','Bids Made')?></li>
                    <li><b><?=  $data['jobsDone']?></b> <?= Yii::t('main','Jobs Done')?></li>
                    <li><b><?=$data['reviewsAboutUser']?> </b><?= Yii::t('main', 'Reviews')?> </li>
                </ul>
                <hr>
                <h4 class="account-title"><?= Yii::t('main', 'Favorite categories')?></h4>
                <div class="account-fav-categories">
                    <ul class="tags">
                        <?php foreach ( $data['favoriteCategories'] as $fav){ ?>
                            <li><a href="" class="tag"><?= $fav?></a></li>
                         <?php }?>
                    </ul>
                </div>
                <hr>
            </div>
                        </div>

    </div>
    <div class="tab-pane fade reviews" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
        <div class="row">
            <div class="col-md-6 ml-auto mr-auto" style="text-align: center;">
                <h3>Total Score 4.5/5</h3>
                <?php
                echo StarRating::widget([
                    'name' => 'rating_21',
                    'value' => 4.5,
                    'pluginOptions' => [
                        'readonly' => true,
                        'showClear' => false,
                        'showCaption' => false,
                    ],
                ]);
                ?>
            </div>
        </div>
    <div class="row">
        <div class="col-6">
            <div class="review effect box">
                <div class="review-writer-photo">
                    <img class="rounded" src="<?= \Yii::$app->request->baseUrl?>/images/logo/logo.png?>" alt="">
                </div>
                <div class="review-info">
                    <h4 class="review-title">I wrote this title</h4>
                    <?php
                    echo StarRating::widget([
                        'name' => 'rating_21',
                        'value' => 2.5,
                        'pluginOptions' => [
                            'readonly' => true,
                            'showClear' => false,
                            'showCaption' => false,
                            'size' => 'xs',
                        ],
                    ]);
                    ?>
                    <p class="review-content">This review is about this guy who is FUCKING AWESOME and did a great job with this site.</p>
                    <span class="review-date">writing in 2021.3.11</span>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="review effect box">
                <div class="review-writer-photo">
                    <img class="rounded" src="<?= \Yii::$app->request->baseUrl?>/images/logo/logo.png?>" alt="">
                </div>
                <div class="review-info">
                    <h4 class="review-title">I wrote this title</h4>
                    <?php
                    echo StarRating::widget([
                        'name' => 'rating_21',
                        'value' => 2.5,
                        'pluginOptions' => [
                            'readonly' => true,
                            'showClear' => false,
                            'showCaption' => false,
                            'size' => 'xs',
                        ],
                    ]);
                    ?>
                    <p class="review-content">This review is about this guy who is FUCKING AWESOME and did a great job with this site.</p>
                    <span class="review-date">writing in 2021.3.11</span>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="review effect box">
                <div class="review-writer-photo">
                    <img class="rounded" src="<?= \Yii::$app->request->baseUrl?>/images/logo/logo.png?>" alt="">
                </div>
                <div class="review-info">
                    <h4 class="review-title">I wrote this title</h4>
                    <?php
                    echo StarRating::widget([
                        'name' => 'rating_21',
                        'value' => 2.5,
                        'pluginOptions' => [
                            'readonly' => true,
                            'showClear' => false,
                            'showCaption' => false,
                            'size' => 'xs',
                        ],
                    ]);
                    ?>
                    <p class="review-content">This review is about this guy who is FUCKING AWESOME and did a great job with this site.</p>
                    <span class="review-date">writing in 2021.3.11</span>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="review effect box">
                <div class="review-writer-photo">
                    <img class="rounded" src="<?= \Yii::$app->request->baseUrl?>/images/logo/logo.png?>" alt="">
                </div>
                <div class="review-info">
                    <h4 class="review-title">I wrote this title</h4>
                    <?php
                    echo StarRating::widget([
                        'name' => 'rating_21',
                        'value' => 2.5,
                        'pluginOptions' => [
                            'readonly' => true,
                            'showClear' => false,
                            'showCaption' => false,
                            'size' => 'xs',
                        ],
                    ]);
                    ?>
                    <p class="review-content">This review is about this guy who is FUCKING AWESOME and did a great job with this site.</p>
                    <span class="review-date">writing in 2021.3.11</span>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="review effect box">
                <div class="review-writer-photo">
                    <img class="rounded" src="<?= \Yii::$app->request->baseUrl?>/images/logo/logo.png?>" alt="">
                </div>
                <div class="review-info">
                    <h4 class="review-title">I wrote this title</h4>
                    <?php
                    echo StarRating::widget([
                        'name' => 'rating_21',
                        'value' => 2.5,
                        'pluginOptions' => [
                            'readonly' => true,
                            'showClear' => false,
                            'showCaption' => false,
                            'size' => 'xs',
                        ],
                    ]);
                    ?>
                    <p class="review-content">This review is about this guy who is FUCKING AWESOME and did a great job with this site.</p>
                    <span class="review-date">writing in 2021.3.11</span>
                </div>
            </div>
        </div>

    </div>


    </div>
</div>
            </div>

</div>
</div>
</div>