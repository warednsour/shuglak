<div class="job-offer">
    <div class="job-information" id="<?= $data['model']->id ?>">
        <p class="job-offer-details"><?=\Yii::t('main','Job details')?></p>
        <hr>
        <div class="job-offer-header">
            <div class="job-title">
                <h1><?= $data['model']->title; ?></h1>
            </div>
            <div class="job-offer-expire-date">
                <p>
                    <?= \Yii::t('main','Bidding on this Job ends in')?>
                </p>
                <p id="demo"></p>
                <span id ="expire-date"class="<?= $data['model']->expire_date ?>"></span>
            </div>
        </div>

        <hr>
        <div class="job-offer-description">
            <h2><?= $data['model']->description; ?></h2>
        </div>

        <div class="job-offer-pay">
            <h2><?= $data['model']->pay; ?> JD</h2>
        </div>

        <h2><?= $data['model']->place; ?></h2>
        <h2><?= $data['model']->category; ?></h2>
        <h2><?= $data['model']->howlong; ?></h2>
        <h3> <?= $data['model']->views; ?><i class="fas fa-eye"></i>Views</h3>
        <div class="job-offer-published-at">
            <span><?= Yii::t('main','Published at: ') . $new_date = date('Y-m-d', strtotime($data['model']->create_date)); ?></span>
        </div>
    </div>
    <div class="employer-details">
        <p class="employer"><?= \Yii::t('main','About the employer')?></p>
        <ul>
            <li><?=$data['employeer']->name ?></li>
            <li><?=$data['employeer']->company_name?></li>
            <li><?=$data['employeer']->city?></li>
            <li>Show or not ?<?=$data['employeer']->telephone_number?></li>
            <li><?= \Yii::t('main','Member since ') . $data['employeerCreateDate']?></li>
        </ul>
        <div class="employer-verification">
            <p><?=\Yii::t('main','Employer verification')?></p>
            <ul>
                <?php  if($data['employeerEmailVer']){ ?>
                    <li><i class="fas fa-envelope-square verified"></i><p class="verified"><?= \Yii::t('main','Email address verified')?> </p></li>
                <?php      } else { ?>
                    <li><i class="fas fa-envelope-square not-verified"></i><p class="not-verified"><?= \Yii::t('main','Email address verified')?></p></li>
                <?php }  ?>
                <?php if($data['employeerIdentityVer']){?>
                    <li><i class="fas fa-address-card verified"></i><p class="verified"><?= \Yii::t('main','Identity verified')?> </p></li>
                <?php } else {?>
                    <li><i class="fas fa-address-card not-verified"></i> <p class="not-verified"><?= \Yii::t('main','Identity verified')?></p></li>
                <?php }?>
            </ul>
        </div>

    </div>
</div>