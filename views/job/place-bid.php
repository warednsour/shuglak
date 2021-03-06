<?php

use yii\bootstrap4\Button;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="place-bid-container">
    <h5><?= Yii::t('main', 'You can make a bid on this Job!') ?></h5>
    <p><?= Yii::t('main', 'You read the description carefuly, now hit the button Place a bid, and tell the employer a little bit about yourself, make your bid unique, and tell him why he should hire you!') ?></p>
    <?php

    echo Button::widget(['label' => 'Place A bid', 'options' => ['class' => 'btn-lg', 'id' => 'ShowBidForm']]);
    $form = ActiveForm::begin([
        'action' => Url::to(['/ajax/placeabid']),
        'options' => [
        'class' => '', 'id' => 'bidForm',
        'onsubmit' => 'event.preventDefault()'
        ]
    ]);

    $jobId = $data['model']->id;
    $userIdOfBid = \Yii::$app->user->id;
    ?>
    <?= $form->field($data['bid'], 'job_id')->hiddenInput(['value' => $jobId, 'id' => 'jobid', 'class' => $jobId])->label(false); ?>
    <?= $form->field($data['bid'], 'user_id')->hiddenInput(['value' => $userIdOfBid, 'id' => 'userid', 'class' => $userIdOfBid])->label(false); ?>
    <?= $form->field($data['bid'], 'title')->textInput(['placeholder' => 'write your title here', 'id' => 'title']); ?>
    <?= $form->field($data['bid'], 'description')->textarea(['placeholder' => 'write your description here', 'id' => 'description']); ?>
    <?= $form->field($data['bid'], 'paid')->textInput(['placeholder' => 'write how much are you going to get paid', 'id' => 'paid']); ?>
    <?= Html::button('Bid Now', ['class' => 'btn-dark-blue', 'id' => 'placeBidNow']) ?>
    <?php ActiveForm::end() ?>
</div>
<script>

</script>