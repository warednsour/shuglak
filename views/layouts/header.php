<?php


use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

?>

<nav class="myNav">
        <div class="brand">
            <a class="brand-name" href="<?= Yii::$app->homeUrl?>"><?= Yii::$app->name?></a>
            <form class="search-form">
                <input class="search-input input-sm" type="search" placeholder="Search" aria-label="Search">
                <button class="search-btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
        <a href="<?= Yii::$app->homeUrl?>" class="btn">Home</a>
          <a href="<?= Url::to(['/job/addjob'],true)?>" class="btn">Add Job</a>
    <?php if( Yii::$app->user->isGuest) {?>
        <a href="<?= Url::to(['/user/login'])?>" class="btn">Sing In</a>
        <? } else {?>
    <a href="<?= Url::to(['/user/security/logout'])?>" data-method ="POST" class="btn">Logout </a>
    <a href="<?= Url::to(['/user/settings/account'])?>" class="btn"><?= Yii::$app->user->identity->username ?></a>
    <?php } ?>
</nav>
