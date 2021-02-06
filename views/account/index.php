<?php
use yii\base\view;
?>

<div class="tab-content account-main-countainer" id="pills-tabContent">
<?= $this->render('account.php', compact('data')) ?>
    <?= $this->render('settings.php', compact('data')) ?>
    <?= $this->render('verify.php', compact('data')) ?>
    <?= $this->render('messages.php', compact('data')) ?>
<div class="tab-pane fade" id="pills-jobs" role="tabpanel" aria-labelledby="pills-contact-tab">Jobs Hello</div>
<div class="tab-pane fade" id="pills-bids" role="tabpanel" aria-labelledby="pills-contact-tab">Bids Hello</div>
</div>
