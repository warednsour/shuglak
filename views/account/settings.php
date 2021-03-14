<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$user = Yii::$app->user->identity;
?>

<div class="tab-pane fade" id="pills-settings" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="panel-body">
        <div class="row" style="justify-content: space-evenly;">
            <a href="<?= Url::to(['user/settings/account'])?>" >
            <div class="account-settings">
                <h3><?= Yii::t('main','Account Settings')?></h3>
                <h4><?= Yii::t('main','(Security settings)')?></h4>
                <i class="fas fa-lock"></i>
                <hr>
                <ul>
                    <li><?=Yii::t('main','Change Password')?></li>
                    <li><?=Yii::t('main','Change Email')?></li>
                    <li><?=Yii::t('main','Logout')?></li>
                </ul>
            </div>
            </a>
            <a href="<?=Url::to(['user/settings/profile'])?>">
            <div class="personal-information">
                <h3><?= Yii::t('main','Personal Information')?></h3>
                <h4><?= Yii::t('main','(Public info)')?></h4>
                <i class="fas fa-bullhorn"></i>
                <hr>
                <ul>
                    <li><?=Yii::t('main','Name')?></li>
                    <li><?=Yii::t('main','Public Email')?></li>
                    <li><?=Yii::t('main','Profile photo')?></li>
                </ul>
                <hr>
                <div class="profile-strength">
                    <?php if ($user->profile->getProfileStrength() == 100) { ?>
                        <p><?= \Yii::t('main', 'Your Profile now Looks GREAT!')?></p>
                    <?php   }else{ ?>
                        <p><?= \Yii::t('main', 'Complete all the fields to get 100%!')?></p>
                    <?php } ?>
                    <div class="c100 p<?= round($user->profile->getProfileStrength())?> <?= $user->profile->getProfileColorStrength()?>">
                        <span><?= round($user->profile->getProfileStrength())?>%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        </div>
        <div class="tab-content" id="v-pills-tabContent">
            <!--Account Settings -->
            <div class="tab-pane fade show active" id="v-pills-account-settings" role="tabpanel" aria-labelledby="v-pills-account-settings-tab">

            </div>
            <!-- Personal Informations -->
            <div class="tab-pane fade" id="v-pills-personal-informations" role="tabpanel" aria-labelledby="v-pills-personal-informations-tab">


        </div>
    </div>
</div>
</div>
