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
          <?= $this->render('bids.php', compact('data'))?>
          <?= $this->render('jobs.php', compact('data')) ?>
      </div>
 <?php
  } else {
      echo 'it\'s not your profile';
  }?>

