<?php
/* @var $this yii\web\View */

use yii\bootstrap;
use yii\bootstrap4;
use yii\helpers\Url;
use yii\widgets\LinkPager;
// use yii\bootstrap4\LinkPager;
use  kartik\select2\Select2;
use yii\helpers\ArrayHelper;
// use yii\helpers\Html;
use yii\bootstrap\html;
use kartik\slider\Slider;

\rmrevin\yii\fontawesome\CdnProAssetBundle::register($this);
$this->title = 'My Yii Application';

$cityName = 'city_' . Yii::$app->language;
$categoryName = 'title_' . Yii::$app->language;
?>
<div class="container">


    <!-- <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= Yii::$app->request->baseUrl ?>/images/slide1.jpg"" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= Yii::$app->request->baseUrl ?>/images/slide1.jpg"" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= Yii::$app->request->baseUrl ?>/images/slide1.jpg"" class="d-block w-100" alt="...">
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
</div> -->
    <!-- search bar for jobs -->

    <input class="search-main" type="search" placeholder="<?= Yii::t('main', 'Enter title of job or a description') ?>" aria-label="Search" name="keyword" id="keyword">
    <button class="btn-dark-blue" type="submit" style="margin-bottom: 3px;">Search</button>



    <!-- Results The job search -->
    <div class="results">
        <!-- Filter column -->
        <div class="left-column">
            <div class="category-list">
                <label for="category"><?= Yii::t('main', 'Category') ?></label>
                <?= Select2::widget([
                    'name' => 'category',
                    'language' => \Yii::$app->language,
                    'showToggleAll' => false,
                    'size' => Select2::SMALL,
                    'addon' => [
                        'prepend' => [
                            // 'content' => Html::icon('globe')
                        ],
                        'append' => [
                            // 'content' => Html::button(Html::icon('map-marker'), [
                            //     'class' => 'btn btn-primary', 
                            //     'title' => 'Mark on map', 
                            //     'data-toggle' => 'tooltip'
                            // ]),
                            'asButton' => true
                        ]
                    ],
                    'data' => ArrayHelper::map($category, 'id', "$categoryName"),
                    'maintainOrder' => true,
                    'options' => ['placeholder' => \Yii::t("main", "Select a category"), 'multiple' => true],
                    'pluginOptions' => [
                        'tokenSeparators' => [',', ' '],

                        //     'tags' => false,
                        //     'maximumInputLength' => 2,
                        //     'maximumSelectionSize' => 3,
                        //     'maximumSelectionLength' => 3,
                        //     'size' => 3,
                    ],
                ]);
                ?>
            </div>
            <div class="city-list">
                <label for="city"> <?= Yii::t('main', 'City') ?></label>
                <?php
                echo Select2::widget([
                    'name' => 'city',
                    'language' => \Yii::$app->language,
                    'showToggleAll' => false,
                    'size' => Select2::SMALL,
                    'addon' => [
                        'prepend' => [
                            // 'content' => Html::icon('globe')
                        ],
                        'append' => [
                            // 'content' => Html::button(Html::icon('map-marker'), [
                            //     'class' => 'btn btn-primary', 
                            //     'title' => 'Mark on map', 
                            //     'data-toggle' => 'tooltip'
                            // ]),
                            'asButton' => true
                        ]
                    ],
                    'data' => ArrayHelper::map($city, 'id', "$cityName"),
                    'maintainOrder' => true,
                    'options' => ['placeholder' => \Yii::t("main", "Select a City"), 'multiple' => true],
                    'pluginOptions' => [
                        'tokenSeparators' => [',', ' '],

                        //     'tags' => false,
                        //     'maximumInputLength' => 2,
                        //     'maximumSelectionSize' => 3,
                        //     'maximumSelectionLength' => 3,
                        //     'size' => 3,
                    ],
                ]);
                ?>
            </div>
            <div class="paying-range">
            <label class="paying-range-label"for="paid" style="display: block;"><?= Yii::t('main', 'Paying Range') ?></label>
            <?php
            // A range select. Value must be passed as a delimited list separated by a `,` (comma). 
            // If your value is passed as a single number, and you have set `pluginOptions['range']`
            // to `true`, then `max` will be used for second value.
            echo '<b class="badge">10 JD</b> ' . Slider::widget([
                'name' => 'paid',
                'value' => '250,650',
                'sliderColor' => Slider::TYPE_GREY,
                'pluginOptions' => [
                    'min' => 10,
                    'max' => 1000,
                    'step' => 5,
                    'range' => true,
                    'tooltip' => 'show',
                ],
            ]) . ' <b class="badge"> 1,000 JD</b>';

            ?>

            </div>

        </div>
        <!-- Results -->
        <div class="right-column">
            <div class="filter_data">
            <img id='loading1' alt='Looking for Jobs' src='/basic/web/images/loading.gif' style="display: hide;">
            </div>
            <button id="loadMore" class="btn-dark-blue btn-block" style="vertical-align: bottom;">
                <?= Yii::t('main', 'Load More') ?>
            </button>
            <div id="loading">

            </div>
        </div>

    </div>
</div>
<?php echo $this->render('../chat/chatbox.php'); ?>