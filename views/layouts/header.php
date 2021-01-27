<?php


use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

?>
<div class="site-header">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i><?=Yii::t('Main','Yes Yes')?></h4>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>


    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i><?=Yii::t('Main','No No')?></h4>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>
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



