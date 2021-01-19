<?php
/* @var $this yii\web\View */

use yii\bootstrap;
use yii\bootstrap4;
use yii\helpers\Url;
//use yii\widgets\LinkPager;
use yii\bootstrap4\LinkPager;

\rmrevin\yii\fontawesome\CdnProAssetBundle::register($this);
$this->title = 'My Yii Application';

$cityName = 'city_' . Yii::$app->language;
$categoryName = 'title_' . Yii::$app->language;
?>
<div class="container">


<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="..." class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- search bar for jobs -->
<form class="search-form">
    <input class="search-main" type="search" placeholder="Search" aria-label="Search">
    <button class="btn-dark-blue" type="submit" style="margin-bottom: 3px;">Search</button>
</form>


<!-- Results The job search -->
<div class="results">
    <!-- Filter column -->
    <div class="left-column">
        <div class="category-list">
            <p>Category</p>
            <ul>
                <?php $i = 0; foreach ($category as $cat) {
                    if($i < 4) {?>
                <li><input type="checkbox" value="<?= $cat->$categoryName?>"><?= $cat->$categoryName ?></li>
                                <?php  } else { ?>
                        <li class="hide"><input  type="checkbox" value="<?= $cat->$categoryName?>"><?= $cat->$categoryName ?></li>
                <?php    } $i++; }?>
                <p class="show-more-category">Show more</p>
            </ul>
        </div>
        <div class="city-list">
            <p>City  </p>
            <ul>
                <?php $x = 0;  foreach ($city as $c) {
                if($x < 4) {?>
                    <li><input type="checkbox" value="<?= $c->$cityName; ?>"><?= $c->$cityName ?></li>
                <?php  } else { ?>
                    <li class="hide"><input  type="checkbox" value="<?= $c->$cityName ?>"><?= $c->$cityName  ?></li>
                <?php    } $x++;}?>
                <p class="show-more-city">Show more</p>
            </ul>
        </div>
        <h3>Paid</h3>
        <p id="paid_show"> 0 - 1000 </p>
        <input type="range" id="paid" value="0" min="0" max="1000">
        <h3>title</h3>
        <input type="text" id="title">
        <h3>Description</h3>
        <input type="text" id="description">
        <h3>how long</h3>
        <input type="text" id="howlong">
        <h3>city</h3>
    </div>
    <!-- Results -->
    <div class="right-column">
        <div class="filter_data">
            <button id = "loadMore" class="btn-primary btn-block">
                Load More
            </button>
        </div>
    </div>
</div>
</div>
<style>
    #loading {
        text-align: center;
        /*background: url('photos/loader_800.gif') no-repeat center;*/
        position: absolute;
        justify-content: center;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 9;
    }
</style>
<?php
$actionIndex = Url::to(['ajax/filter']);

$this->registerJs("

    //To filter the results
    
    $(document).ready(function(){
        
        
       var page = 0;
        
            
        filter_data();
       
       function filter_data() {

              $.ajax({
             url : '$actionIndex' + '?page=' + page,
            type : 'POST',
          
            data: {
            'title' : $('#title').val(),
            'description' : $('#description').val(),
            'place' : get_filter('city'),
            'pay' : $('#paid').val(),
            },
            success:function(data){
            
                $('.filter_data').html(data);
            }
          
        })
        
         
    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
         
       }
       
    $('.common_selector').click(function(){
        filter_data();
    });
    
    $('#title').on('keyup',function(){
              filter_data();
       })

     $('#filter').on('click',function(){
          page++;  
        filter_data()
        })

 function ready() {
    for(var i = 0 ; $('#loading').length ; i ++ ){
    $('#loading').fadeOut();
    }
}

  $('#loadMore').on('click',function(){
        page++;
      filter_data();
        });
})

    $('#allcities').hover(function(){
        
        $(this).children('option').stop(true,false,true).slideToggle(400);
    })
    
    
   $('.select-city').on('click', () => {
   
        if($('.city-list').hasClass('show-city-list')){
            $('.city-list').removeClass('show-city-list').addClass('hide-city-list');
             $('.arrow-city').addClass('fa-arrow-circle-down').removeClass('fa-arrow-circle-up');
        } else {
            $('.city-list').addClass('show-city-list').removeClass('hide-city-list');
            $('.arrow-city').addClass('fa-arrow-circle-up').removeClass('fa-arrow-circle-down');
            $('.city-list').slideDown();
        }
       
   })
   
     $('.select-category').on('click', () => {
   
        if($('.category-list').hasClass('show-category-list')){
            $('.category-list').removeClass('show-category-list').addClass('hide-category-list');
             $('.arrow-category').addClass('fa-arrow-circle-down').removeClass('fa-arrow-circle-up');
        } else {
            $('.category-list').addClass('show-category-list').removeClass('hide-category-list');
            $('.arrow-category').addClass('fa-arrow-circle-up').removeClass('fa-arrow-circle-down');
        }
       
   })
    
    

") ?>




