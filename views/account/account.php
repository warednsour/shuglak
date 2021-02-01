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
                            <button class="btn btn-fab btn-primary btn-round" rel="tooltip" title="" data-original-title="Edit your profile">
                                <i class="fas fa-user-edit"></i>
                            </button>
                        </div>
                        <div class="avatar">
                            <img src="<?= \Yii::$app->request->baseUrl?>/images/logo/logo.png?>" alt="" class ="account-img">
                        </div>
                        <div class="account-name">
                            <h3 class="account-title"> Ward Nsour</h3>
                            <h6>Chrome for web Design</h6>
                            <h6>As-Salt</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="account-bio text-center">
                <p>The best PHP developer in 21th century, amazing performance in bulding websites up
                    from the ground and making everything looks great!
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
                                    <div class="col-md-6">
                                        <div class="card card-background" style=' background-image: url('<?php echo "ward"?>')'>
                                        <div class="card-body">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-background" style=' background-image: url('<?php echo "ward"?>')'>
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-background" style=' background-image: url('<?php echo "ward"?>')'>
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-background" style=' background-image: url('<?php echo "ward"?>')'>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mr-auto ml-auto stats">
                <h4 class="account-title">Stats</h4>
                <ul class="list-unstyled">
                    <li><b>60</b> Jobs Done</li>
                    <li><b>4</b> Bids Made</li>
                    <li><b>331</b> Jobs offered</li>
                    <li><b>1.2K</b> Reviews</li>
                </ul>
                <hr>
                <h4 class="account-title">Favorite categories</h4>
                <div class="account-fav-categories">
                    <ul class="tags">
                        <li><a href="" class="tag">PHP</a></li>
                        <li><a href="" class="tag">Jquery</a></li>
                        <li><a href="" class="tag">Ajax</a></li>
                        <li><a href="" class="tag">Mysql N Database</a></li>
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