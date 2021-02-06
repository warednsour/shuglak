<?php


use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
$username = \Yii::$app->user->identity->username;
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
                <a href="<?= Url::to(["/$username"])?>" class="nav-link"">Account</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link active"  href="<?= Url::to(["/$username#pills-settings"])?>" aria-selected="false">Settings</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link"  href="<?= Url::to(["/$username#pills-verify"])?>"  aria-selected="false">Verify</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="<?= Url::to(["/$username#pills-messages"])?>"  aria-selected="false">Messages</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link"  href="<?= Url::to(["/$username#pills-jobs"])?>" aria-selected="false">Jobs</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="<?= Url::to(["/$username#pills-bids"])?>"   aria-selected="false">Bids</a>
            </li>
        </ul>
    </nav>
</div>




