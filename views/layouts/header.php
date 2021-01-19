<?php


use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

?>
<div class="site-header">
    <div class="nav-container">
        <div class="corset">
            <div class="brand">
                <a class="brand-name" href="<?= Yii::$app->homeUrl?>">
                    <img class="logo" src="<?= Yii::$app->request->baseUrl?>/images/logo/logo.png" alt="<?= Yii::$app->name?>">
                </a>
            </div>
            <nav class="myNav">
                <a href="<?= Url::to(['/job/addjob'],true)?>" class="nav-link-head">Add Job</a>
                <?php if( Yii::$app->user->isGuest) {?>
                    <a href="<?= Url::to(['/user/login'])?>" class="nav-link-head">Sing In</a>
                <? } else {?>
                    <a href="<?= Url::to(['/user/settings/account'])?>" class="nav-link-head"><?= Yii::$app->user->identity->username ?></a>
                <?php } ?>
            </nav>
        </div>
    </div>
</div>



