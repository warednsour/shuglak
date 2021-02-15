<?php
use yii\base\view;
?>
  <?php
  //Double check if it's the user's account or not.
  //if it's his account he will be able to edit and see messages and settings etc.
  if(is_bool($data['userOwnAccount']) && $data['userOwnAccount'] === true ){ ?>
      <div class="tab-content account-main-countainer" id="pills-tabContent">
          <?= $this->render('account.php', compact('data')) ?>
          <?= $this->render('settings.php', compact('data')) ?>
          <?= $this->render('verify.php', compact('data')) ?>
          <?= $this->render('messages.php', compact('data')) ?>
          <div class="tab-pane fade" id="pills-jobs" role="tabpanel" aria-labelledby="pills-contact-tab">Jobs Hello</div>
          <div class="tab-pane fade" id="pills-bids" role="tabpanel" aria-labelledby="pills-contact-tab">Bids Hello</div>
      </div>
 <?php
      //if it's not his account then.
  } else {
      echo 'it\'s not your profile';
  }?>

