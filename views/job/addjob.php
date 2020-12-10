<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<?//phpecho \pigolab\locationpicker\LocationPickerWidget::widget(['key' => 'AIzaSyBWI2cyUSaCLExmXTG4HHW44RQM-G3qDeQ']); ?>
<div class="container">
    <div class="align-content-center">
        <div class="form-group-sm">
<?php echo date('Y-m-d h:i:s ',time())?>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['/upload/jobadd']),
    'options' => [
//    'class' => 'form-horizontal col-md-12',
        'enctype' => 'multipart/form-data',
                ]
]); ?>

<?php echo $form->field($data['model'], 'expire_date')->widget(DateTimePicker::classname(), [
    'options' => [
        'placeholder' => 'Enter birth date ...',
        'autoComplete' => 'off',
    ],
    //'convertFormat' => true,
    'language' => 'ar',

    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd hh:ii:ss',

    ]
]);?>
<?//= $form->field($data['model'], 'expire_date')->widget(DateTimePicker::classname(), [
//////    'model' => $data['model'],
//////    'attribute' => 'expire_date',
////    'options' => ['placeholder' => 'Enter event time ...','value'=>date('Y-m-d h:m:s ',time())],
////    'convertFormat' => true,
////    'pluginOptions' => [
////        'format' => 'y-m-d h:m:s',
////        'autoclose' => true,
////       // 'startDate' => date('Y-m-d h:m:s ',time()),
////      //  'autoComplete' => false,
////     //   'minDate' => date('Y-m-d h:m:s ',time()),
////    ]
//]);
//?>
<div class="wrap-input100 validate-input" data-validate="Name is required" style="  width: 100%;
  position: relative;
  border-bottom: 2px solid #dbdbdb;
  margin-bottom: 45px;">
<?= $form->field($data['model'],'title', ['options'=> ['style' => 'display: block;
  height: 50px;
  background: transparent;
  font-size: 22px;
  color: #555555;
  line-height: 1.2;
  padding: 0 2px;
  outline: none;'
]]); ?>
</div>
<?= $form->field($data['model'], 'description') ?>
<?= $form->field($data['model'], 'category') ?>
<?= $form->field($data['model'], 'howlong') ?>
<?= $form->field($data['model'], 'pay') ?>
<?=

$form->field($data['model'], 'place')->dropDownList(
    [
        'Amman' => 'Amman' ,
        'Assalt' => 'Assalt',

    ],
    ['prompt'=>'Select...']);

?>

<?= Html::submitButton('Submit') ?>
<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>