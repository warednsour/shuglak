<?php
/* @var $this yii\web\View */
use yii\bootstrap;
use yii\bootstrap4;
use yii\helpers\Url;
//use yii\widgets\LinkPager;
use yii\bootstrap4\LinkPager;

$this->title = 'My Yii Application';
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>We will help you find your next job!</h1>
    </div>

    <div class="body-content row ">
        <div class="col-md-3">
            <a type="button" class="btn btn-primary" id="filter">Search</a>
            <div class="list-group">
                <h3>Paid</h3>

                <p id="paid_show"> 0 - 1000 </p>
                <input type="range" id = "paid" value="0" min="0" max="1000">
                <h3>title</h3>
                <input type="text" id = "title">
                <h3>Description</h3>
                <input type="text" id ="description">
                <h3>how long</h3>
                <input type="text" id = "howlong">
            </div>
            <div class="list-group">
                <h3>city</h3>
                <?php
                foreach($city as $c){ ?>
                    <div class="list-group-item checkbox">
                        <label><input class="common_selector brand" type="checkbox" value="<?= $c->city?>" id="city"><?= $c->city?></label>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <?php foreach($jobs as $job) {
            ?>
            <div class="card col-md-3" style="width: 18rem;">
                <div id = "loading"></div>
                <div class="card-body">
                    <h5 class="card-title"><?=$job->title?></h5>
                    <p class="card-text text-muted"><?= $job->description?></p>
                    <p class="card-text text-muted"><?= $job->pay?></p>
                    <a href="<?= Url::to(['job/showjob', 'link' => $job->link]); ?>" class="btn btn-primary">Bid Now!</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php

echo LinkPager::widget([
    'pagination' => $pagination,
//            'options' => ['class' => ''],
//            //First option value
//            'firstPageLabel' => '&nbsp;',
//            //Last option value
//            'lastPageLabel' => '&nbsp;',
//            //Previous option value
//            'prevPageLabel' => '&nbsp;',
//            //Next option value
//            'nextPageLabel' => '&nbsp;',
//            //Current Active option value
//            'activePageCssClass' => 'p-active',
//            //Max count of allowed options
//            'maxButtonCount' => 8,
//
//            // Css for each options. Links
//            'linkOptions' => ['class' => ''],
//            'disabledPageCssClass' => 'disabled',
//
//            // Customzing CSS class for navigating link
//            'prevPageCssClass' => 'p-back',
//            'nextPageCssClass' => 'p-next',
//            'firstPageCssClass' => 'p-first',
//            'lastPageCssClass' => 'p-last',
]);

?>

<style>
    /*#loading {*/
    /*    text-align: center;*/
    /*    background: url('photos/loader_800.gif') no-repeat center;*/
    /*     position: absolute;*/
    /*  justify-content: center;*/
    /*    left: 0;*/
    /*    height: 100%;*/
    /*    width: 100%;*/
    /*    z-index: 9999999;*/
    /*}*/
</style>
<?php
$actionIndex = Url::to(['site/filter']);

$this->registerJs("

    //To filter the results

     $('#filter').on('click',function(){



       $.ajax({
             url : '$actionIndex',
            type : 'GET',
            dataType: 'json',
            data: {
            'title' : $('#title').val(),
            'description' : $('#description').val(),
            'place' : $('#city').val(),
            'pay' : $('#paid').val(),
            }
        })

     })

 function ready() {
    for(var i = 0 ; $('#loading').length ; i ++ ){
    $('#loading').fadeOut();
    }
}


//$(document).ready(ready);


") ?>




