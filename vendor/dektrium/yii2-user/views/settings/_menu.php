<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use dektrium\user\widgets\UserMenu;

/**
 * @var dektrium\user\models\User $user
 */

$user = Yii::$app->user->identity;
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="text-center mr-bt-1">
            <?= Html::img($user->profile->getAvatarUrl(200), [
                'class' => 'rounded-circle',
                'alt' => $user->username,
            ]) ?>
        </div>
    </div>
    <div class="panel-heading">
        <h3 class="panel-title text-center">
            <?= $user->profile->name ? $user->profile->name : $user->username ?>
        </h3>
        <p class="panel-title text-center">
            <?= $user->profile->company_name  ?>
        </p>

        <p class="panel-title text-center">
            <?= $user->profile->public_email ?>
        </p>
        <p class="panel-title text-center">
            <?= $user->profile->telephone_number ?>
        </p>
        <hr>
        <div class="profile-strength">
            <p><?= \Yii::t('main', 'Complete all the fields to get 100%!')?></p>
            <div class="c100 p<?= round($user->profile->getProfileStrength())?> green">
                <span><?= round($user->profile->getProfileStrength())?>%</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>
        </div>

    </div>
<!--    <div class="panel-body">-->
<!--        --><?//= UserMenu::widget() ?>
<!--    </div>-->
</div>
