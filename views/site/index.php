<?php
/* @var $this yii\web\View */
use yii\bootstrap;
use yii\bootstrap4;
use yii\helpers\Url;
//use yii\widgets\LinkPager;
use yii\bootstrap4\LinkPager;

\rmrevin\yii\fontawesome\CdnProAssetBundle::register($this);
$this->title = 'My Yii Application';
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>We will help you find your next job!</h1>
    </div>


    <nav style="width: 100%; background-color: white; margin: auto;">
        <a type="button" class="btn btn-primary" id="filter">Search</a>
        <input type="text" id = "title">


    <!--Category  -->

        <div class="dropdown-menu-lg table-bordered select-category" style="">
            <label for="">choose your category</label><span class="fas fa-arrow-circle-down arrow-category" style="margin-left: 9%;"></span>
        </div>
        <div class="category-list list-group-horizontal hide-category-list">
            <?php foreach($category as $cat){ ?>
                <div class="list-group-item checkbox">
                    <label><input class="common_selector category" type="checkbox" value="<?= $cat->title_en?>" id="category_id"><?= $cat->title_en?></label>
                </div>
            <?php  } ?>
        </div>

        <!-- City -->
        <div class="dropdown-menu-lg table-bordered select-city" style="">
            <label for="">city</label><span class="fas fa-arrow-circle-down arrow-city"style="margin-left: 9%;"></span>

        </div>
        <div class="city-list list-group-horizontal hide-city-list">
            <?php foreach($city as $c){ ?>
                <div class="list-group-item checkbox">
                    <label><input class="common_selector city" type="checkbox" value="<?= $c->city?>" id="city_id"><?= $c->city?></label>
                </div>
            <?php  } ?>
        </div>
    </nav>

    <div class="body-content row ">
        <div class="col-md-3">

            <div class="list-group">
                <h3>Paid</h3>

                <p id="paid_show"> 0 - 1000 </p>
                <input type="range" id = "paid" value="0" min="0" max="1000">
            <h3>title</h3>

            <h3>Description</h3>
            <input type="text" id ="description">
            <h3>how long</h3>
            <input type="text" id = "howlong">
            </div>
            <div class="list-group">
                <h3>city</h3>

            </div>
        </div>
         <div class="row filter_data">

                </div>
<?php ?>
    </div>
</div>
<!--        --><?php
//
//        echo LinkPager::widget([
//                'pagination' => $pagination,
////            'options' => ['class' => ''],
////            //First option value
////            'firstPageLabel' => '&nbsp;',
////            //Last option value
////            'lastPageLabel' => '&nbsp;',
////            //Previous option value
////            'prevPageLabel' => '&nbsp;',
////            //Next option value
////            'nextPageLabel' => '&nbsp;',
////            //Current Active option value
////            'activePageCssClass' => 'p-active',
////            //Max count of allowed options
////            'maxButtonCount' => 8,
////
////            // Css for each options. Links
////            'linkOptions' => ['class' => ''],
////            'disabledPageCssClass' => 'disabled',
////
////            // Customzing CSS class for navigating link
////            'prevPageCssClass' => 'p-back',
////            'nextPageCssClass' => 'p-next',
////            'firstPageCssClass' => 'p-first',
////            'lastPageCssClass' => 'p-last',
//            ]);
//
//        ?>

<style>
    #loading {
        text-align: center;
        background: url('photos/loader_800.gif') no-repeat center;
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
        
            
        filter_data()
       
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



