<?php

use app\models\DialogForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$footer =
    Html::tag(
        'button',
        Yii::t('main', 'Cancel'),
        [
            'type' => 'button',
            'class' => 'btn btn-secondary',
            'data-dismiss' => 'modal',

        ]
    )
    .
    Html::tag(
        'span',
        Yii::t('main', 'Send'),
        [
            'id' => 'writeNewMsgSend',
            'class' => 'btn btn-primary',
        ]
    );

Modal::begin(
    [
        'id' => 'writeNewMsg',
        'header' => Yii::t('main', 'Write New Message'),
        'headerOptions' => ['class' => 'modal-title arab'],
        'closeButton' => ['class' => 'close arab-close-modal', 'tag' => 'button', 'label' => '&times;'],
        'bodyOptions' => ['class' => 'modal-body arab'],
        'footer' => $footer,

    ]
);
$model = new DialogForm;
$form = ActiveForm::begin(
    [
        'id' => 'dialog_footer-form',
        'action' => '/ajax/dialog',
    ]
);

echo $form->field($model, 'title')->textInput(['id' => 'dialog_footer-title'])->label(Yii::t('main', 'Title'));
echo $form->field($model, 'content')->textarea(['rows' => '3', 'id' => 'dialog_footer-content'])->label(Yii::t('main', 'Message'));
echo $form->field($model, 'user_to')->HiddenInput(['id' => 'dialog_footer-user_to'])->label(false);
echo $form->field($model, 'dialog_id')->HiddenInput(['value' => 0, 'id' => 'dialog_footer-dialog_id'])->label(false);


ActiveForm::end();

Modal::end();
