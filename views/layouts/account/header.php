<?php


use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

?>
<div class="account-header">
    <div class="add-job-header-container">
        <div class="add-job-header site-header">
            <a class="brand-name" href="<?= Yii::$app->homeUrl?>">
                <img class="logo add-job-logo" src="<?= Yii::$app->request->baseUrl?>/images/logo/logo.png" alt="<?= Yii::$app->name?>">
            </a>
        </div>
    </div>
    <nav class="account-nav">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-account" role="tab" aria-controls="pills-home" aria-selected="true">Account</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-settings" role="tab" aria-controls="pills-profile" aria-selected="false">Settings</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-verify" role="tab" aria-controls="pills-contact" aria-selected="false">Verify</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-messages" role="tab" aria-controls="pills-contact" aria-selected="false">Messages</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-jobs" role="tab" aria-controls="pills-contact" aria-selected="false">Jobs</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-bids" role="tab" aria-controls="pills-contact" aria-selected="false">Bids</a>
            </li>
        </ul>
    </nav>
</div>




