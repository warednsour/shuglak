<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\bootstrap\Modal;
?>

            <p><?=Yii::t('main','Congratulations! You have been hired for this Job now you can write a message to the employer')?></p>
            <a class="btn btn-info " data-toggle="modal" data-target="#writeNewMsg">Write Message</a>
<?php

$footer =
    Html::tag(
        'button',
        'Cancel',
        [
            'id' => 'close-modal-msg',
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
            'id' => 'writeNewMsgSend',
            'class' => 'btn btn-primary',
//                'onClick' => 'hideMsgSend()',
            'type' => 'submit',
        ]
    );
//    .
//    $success;
Modal::begin(
    [

        'id' => 'writeNewMsg',
        'header' => 'Write New Message',
        'headerOptions' => ['class' => 'modal-title arab'],
        'closeButton' => ['class' => 'close arab-close-modal', 'tag' => 'button', 'label' => '&times;'],
        'bodyOptions' => ['class' => 'modal-body arab'],
        'footer' => $footer,

    ]
);


$form = ActiveForm::begin(
    [
        'id' => 'message-form',
        'action' => '/ajax/message',
        'method' => 'POST',
    ]
);

$receiver = $data['employeer']->user_id;
echo $form->field($data['message'], 'title')->textInput(['value' => '', 'placeholder' => 'write your title here', 'id' => 'dialog_footer-title'])->label('Title');
echo $form->field($data['message'], 'text')->textarea(['rows' => '3', 'id' => 'message_footer-content'])->label('Message');
echo $form->field($data['message'], 'receiver_id')->HiddenInput(['value' => $receiver, 'id' => $receiver, 'class'=>'receiver'])->label(false);
echo $form->field($data['message'], 'sender_id')->HiddenInput(['value' => Yii::$app->user->getId(), 'id' => Yii::$app->user->getId(),'class'=>'sender'])->label(false);
ActiveForm::end();

Modal::end();
?>
