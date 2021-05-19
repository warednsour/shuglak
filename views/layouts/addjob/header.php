<?php


use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

?>
<div class="add-job-main">



    <div class="add-job-header-container">
        <div class="add-job-header site-header">
            <a class="brand-name" href="<?= Yii::$app->homeUrl?>">
                <img class="logo add-job-logo" src="<?= Yii::$app->request->baseUrl?>/images/logo/logo.png" alt="<?= Yii::$app->name?>">
            </a>
        </div>
        <div class="add-job-information">
            <h5><?= \Yii::t('main', 'Now Please Tell us more about your Job offer')?></h5>
            <p><?= \Yii::t('main', 'joboffer-description')?></p>
        </div>
    </div>
</div>




