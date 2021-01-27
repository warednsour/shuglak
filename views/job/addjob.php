<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php
$cityName = 'city_' . Yii::$app->language;
$cities = [];
        foreach ($data['cities'] as $city){
            array_push($cities,$city->$cityName);
        }
$categoryTitle = 'title_' . Yii::$app->language;
$categories = [];
        foreach ($data['categories'] as $category){
            array_push($categories,$category->$categoryTitle);
        }
function erase_val(&$myarr) {
    $myarr = array_map(create_function('$n', 'return null;'), $myarr);
}


?>


<?php $form = ActiveForm::begin([
    'action' => Url::to(['/upload/jobadd']),
    'options' => [
    'class' => 'add-job-form',
        'enctype' => 'multipart/form-data',
                ]
]); ?>
<?= $form->field($data['model'],'title', [
    'template' => '{label}<p class="sub-label">' . \Yii::t("main","Choose a name for your job offer.").'</p> {input}{error}{hint}'
]); ?>
<?php
$now = new DateTime();
echo $form->field($data['model'], 'expire_date' ,['template' =>
    '{label}<p class="sub-label">' . \Yii::t("main","After this date people won't be able to bid on this job no more.").'</p> {input}{error}{hint}'
    ])
    ->widget(DateTimePicker::classname(), [

    'options' => [
        'placeholder' => \Yii::t("main","Enter a date..."),
        'autoComplete' => 'off',

    ],
    //'convertFormat' => true,
    'language' => "Yii::$app->language;",

    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd hh:ii:ss',
        'startDate' => date_format($now, 'Y-m-d'), //startDate Date. Default: Beginning of time The earliest date that may be selected; all earlier dates will be disabled.
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
<?= $form->field($data['model'], 'description',['template' =>
    '{label}<p class="sub-label">' . \Yii::t("main","In a few words what exactly do you need to be done?").' </p>{input}{error}<div class="counter-container" style="display: none;"><p class="counter-text" style="margin-right: 3px;">255   </p><span>' . \Yii::t("main","characters remained") . '</span></div>{hint}'
    ])->textarea(['rows'=>6 , 'cols' => 30 , 'maxlength' => "255"]); ?>

<?=
$form->field($data['model'], 'category',['template' =>
    '{label}<p class="sub-label">' . \Yii::t("main","Let it be Uniqe!").'</p> {input}{error}{hint}'
])->dropDownList(ArrayHelper::map($data['categories'],'id',"$categoryTitle"),['prompt'=>\Yii::t("main","Select a category")]) ?>
<?= $form->field($data['model'], 'howlong',['template' =>
    '{label}<p class="sub-label">' . \Yii::t("main","Let it be Uniqe!").'</p> {input}{error}{hint}'
]) ?>
<?= $form->field($data['model'], 'pay',[
    'template' => '{label}<p class="sub-label">' . \Yii::t("main","how much do you think it's worth?").'</p> <div class="col-sm-3 pay-input">{input}<p>JD</p></div>{error}{hint}',
//    'options' => ['class' => 'ward']
]) ?>
<?= $form->field($data['model'],
    'place',['template' =>
    '{label}<p class="sub-label">' . \Yii::t("main","Make it easier for people to find your job location.").'</p> {input}{error}{hint}'
])->dropDownList(ArrayHelper::map($data['cities'],'id',"$cityName"), ['prompt'=>'Select...']); ?>



<?= $form->field($data['model'],
    'file[]',
    ['template' =>     '{label}<p class="sub-label">' . \Yii::t("main","Upload more files to explain or to show people what you need to be done, you can add images or PDF files.").'</p> {input}{error}{hint}',
//        'options' => ['class' => 'ward']
    ])
    ->fileInput(['Multiple'=> true ])?>
<div id="selectedFiles"></div>
<?= Html::submitButton('Submit' , ['class' =>'btn-dark-blue'] ) ?>
<?php ActiveForm::end(); ?>

<script>


</script>