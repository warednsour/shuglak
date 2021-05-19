<?php
use yii\helpers\Url;
?>

<h1>Hello from jobs of user</h1>
<?php  $bidId = $bidsOnJob['bids']->id;?>

      <div class="container">
    <div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>

<?php     foreach ($job['job'] as $j) { ?>
          <div class="col-sm-3">
              <p><?=$j->title?></p>
                <p><?=$j->description?></p>
                 <p><?=$j->views?></p>
              <p><?=$j->howlong?></p>
             <p>There is <?php echo count($bidsOnJob['bids']); ?> bid(s)on this job<a href="<?= Url::to(['/job/showjob/', 'link' => $j->link])?>"><button class="btn btn-block btn-success">Click here</button></a></p>
          </div>
<?php }
?>
      </div>
    </div>
