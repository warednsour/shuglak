<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\cities;

?>

<h1>Hello there!</h1>

<?php
$form = ActiveForm::begin(); ?>
 <?= $form->field($model,'title') ?>
<?= $form->field($model, 'description') ?>
<?= $form->field($model, 'category') ?>
<?= $form->field($model, 'howlong') ?>
<?= $form->field($model, 'pay') ?>
<?=

 $form->field($model, 'place')->dropDownList(
       [
           'Amman' => 'Amman' ,
            'Assalt' => 'Assalt',

       ],
          ['prompt'=>'Select...']);
?>

<?= Html::submitButton('Submit') ?>
<?php ActiveForm::end(); ?>
