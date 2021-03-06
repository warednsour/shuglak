<?php
use kartik\rating\StarRating;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<hr style="width: 100%; color: black; height: 1px; background-color:black;">
<h1>People who all ready made bids on this job!</h1>
<?php

if (!Yii::$app->user->isGuest && Yii::$app->user->identity) {
    foreach ($data['bids'] as $bid) {
        foreach ($data['bidders'] as $bidder) {
            if($bid->user_id == $bidder->user_id){


       ?>
        <div class="bid">
            <p class="bid-title"><?= $bid->title?></p>
            <p class="bid-description"><?= $bid->description?></p>
            <div class="bidder-information">
                <img src="<?= Yii::getAlias("@webroot/uploads/2021-Mar-04-16-36-14-000000---4/azad.png")?>" alt="">
            </div>
        </div>

        echo $bidder->paid . "<br>";
        echo $bidder->job_id . "<br>";
        echo $bidder->user_id . "<br>";
        echo $bidder->status . "<br>";
        if (!Yii::$app->user->isGuest && $data['userIsEmployeer']) {
        if (Yii::$app->user->identity) { ?>
        <button
            class="btn btn-info "
            data-toggle="modal" data-target="#writeNewMsgToBidder">Write Message to bidder
        </button>

        <?php if ($bid->status == 0) { ?>
            <button id="hire" class="btn btn-outline-dark btn-group-sm btn-danger hireHim"
                    value="<?= $bid->id ?>" formmethod="post"> hire him
            </button>
        <?php } elseif ($bid->status == 1) { ?>
            <div class="row">
                <div class="col-md-4">
                    <button id="jobDone" class="btn btn-outline-dark btn-group-sm btn-danger jobDone"
                            value="<?= $bid->id ?>" formmethod="post">The job is done
                    </button>
                    <button id="jobNot" class="btn btn-outline-dark btn-group-sm btn-danger jobNot"
                            value="<?= $bid->id ?>" formmethod="post"> The job was not complited
                    </button>
                </div>
            </div>
        <?php } elseif ($bid->status == 2 || $bid->status == 3) { ?>
            <div class="row">
                <div class="col-md-4">
                    <button id="jobDone" data-toggle="modal" data-target="#review" class="btn btn-dark btn-group-sm btn-block feedback"
                            value="<?= $bid->id ?>" formmethod="post">leave a review please!
                    </button>
                </div>
            </div>
            <?php

            $footer =
                Html::tag(
                    'button',
                    'Cancel',
                    [
                        'id' => 'close-modal-msg-to-bidder',
                        'type' => 'button',
                        'class' => 'btn btn-secondary',
                        'data-dismiss' => 'modal',

                    ]
                )

                .
                Html::tag(
                    'span',
                    'Send',
                    [
                        'id' => 'writeNewMsgToBidder',
                        'class' => 'btn btn-primary',
                        'type' => 'submit',
                    ]
                );
//    .
//    $success;
            Modal::begin(
                [

                    'id' => 'writeNewMsgToBidder',
                    'header' => 'Write New Message',
                    'headerOptions' => ['class' => 'modal-title arab'],
                    'closeButton' => ['class' => 'close arab-close-modal', 'tag' => 'button', 'label' => '&times;'],
                    'bodyOptions' => ['class' => 'modal-body arab'],
                    'footer' => $footer,

                ]
            );


            $form = ActiveForm::begin(
                [
                    'id' => 'message-to-bidder-form',
                    'action' => '/ajax/message',
                    'method' => 'POST',
                ]
            );

            $receiver = $bidder->user_id;
            echo $form->field($data['message'], 'title')->textInput(['value' => '', 'placeholder' => 'write your title here', 'id' => 'dialog_footer-title'])->label('Title');
            echo $form->field($data['message'], 'text')->textarea(['rows' => '3', 'id' => 'message_footer-content'])->label('Message');
            echo $form->field($data['message'], 'receiver_id')->HiddenInput(['value' => $receiver, 'id' => $receiver, 'class'=>'receiver'])->label(false);
            echo $form->field($data['message'], 'sender_id')->HiddenInput(['value' => Yii::$app->user->getId(), 'id' => Yii::$app->user->getId(),'class'=>'sender'])->label(false);
            ActiveForm::end();
            Modal::end();
            ?>

            <?php
        }
    }
}
}
}
//                 }
//
//            }
?>
</div>

<?php

$footer =
    Html::tag(
        'button',
        'Cancel',
        [
            'type' => 'button',
            'class' => 'btn btn-secondary',
            'data-dismiss' => 'modal',

        ]
    )

    .
    Html::tag(
        'span',
        'submit review',
        [
            'id' => 'reviewSend',
            'class' => 'btn btn-primary',
            //  'onClick' => 'hideReviewSend()',
        ]
    );
//    .
//    $success;
Modal::begin(
    [
        'id' => 'review',
        'header' => 'How did that go?',
        'headerOptions' => ['class' => 'modal-title arab'],
        'closeButton' => ['class' => 'close arab-close-modal', 'tag' => 'button', 'label' => '&times;'],
        'bodyOptions' => ['class' => 'modal-body arab'],
        'footer' => $footer,

    ]
);


$form = ActiveForm::begin(
    [

        'id' => 'review-form',
        'action' => Url::to(['/ajax/review']),
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'ajaxDataType' => 'json',
        'ajaxParam' => 'ajax',
        'method' => 'POST',
    ]
);

//foreach ($data['bids'] as $bidder) {
//    $new_receiver = $bidder->user_id;
//};
//
//
////    if ($data['model']['author']->user_id == Yii::$app->user->getId()) {
////        $receiver = $new_receiver;
////    } else {
////        $receiver = $data['model']['author']->user_id;
////    };
echo $form->field($data['review'], 'review_title')->textInput(['value' => '', 'placeholder' => 'write your title here', 'id' => 'review_footer-title'])->label('Title');
echo $form->field($data['review'], 'review_content')->textarea(['rows' => '3', 'id' => 'review_footer-content'])->label('Tell us in detail');
echo $form->field($data['review'], 'reviewed_id')->HiddenInput(['value' => $receiver, 'id' => 'reviewed_id', 'class'=>'reviewed_id'])->label(false);
echo $form->field($data['review'], 'reviewer_id')->HiddenInput(['value' => Yii::$app->user->getId(), 'id' => 'reviewer_id','class'=>'reviewer_id'])->label(false);
echo $form->field($data['review'], 'job_id')->hiddenInput(['value'=> $data['model']->id , 'class' => 'job_id' ])->label(false);
echo $form->field($data['review'], 'rating')->widget(StarRating::classname(), [
    'pluginOptions' => ['size'=>'lg'],
    'options' => ['class'=> 'rating'],
]);
ActiveForm::end();
Modal::end();
?>
