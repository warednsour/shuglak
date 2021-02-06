<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="tab-pane fade" id="pills-settings" role="tabpanel" aria-labelledby="pills-profile-tab">
    <a href="<?= Url::to(['user/settings/account'])?>" class="nav-link active""><button class="nav-link active">Account Settings</button></a>
    <a href="<?=Url::to(['user/settings/profile'])?>" class="nav-link active"><button class="nav-link active">Personal Information</button></a>

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
