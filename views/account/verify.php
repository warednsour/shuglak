<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$language = Yii::$app->language;
?>
<div class="tab-pane fade" id="pills-verify" role="tabpanel" aria-labelledby="pills-contact-tab">

    <div class="container pt-4">
        <div class="row">
            <?php if ($data['userRequestedVerify'] === true){ ?>
                <div class="col-6 ">
                    <div class ="why-is p-3">
                        <h1><?=Yii::t('main','Now Please Wait until your request is being reviewd')?></h1>
                        <p>
                            <?=Yii::t('main',' Our moderators is now reviewing your request please be pasiont as we have a lot of requests the sign will appear near your photo as your request is accepted')?>

                        </p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-md-6 ml-auto mr-auto" style="text-align: center !important;">
                        <div class="profile">
                            <div class="avatar-verify">
                                <img src="<?= \Yii::$app->request->baseUrl?>/images/icons/no-image-verify.png?>" alt="" class ="account-img">
                                <div class="verify-icon">
                                    <i class="far fa-check-circle verified"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } elseif ($data['userRequestedVerify'] === false) { ?>
            <div class="col-6">
                <div class ="why-is p-3">
                    <h1><?=Yii::t('main','Why it\'s important to verify your account?')?></h1>
                    <p>
                        <?=Yii::t('main',' It\'s important to verify your account to get hired fast than other users does
                        getting verified means you are a person who i can trust to Hire!')?>

                    </p>
                    <button class="verify-start btn-yellow">Let's Start!</button>
                </div>
            </div>
            <div class="col-6">
                <div class="col-md-6 ml-auto mr-auto" style="text-align: center !important;">
                    <div class="profile">
                        <div class="avatar-verify">
                            <img src="<?= \Yii::$app->request->baseUrl?>/images/icons/no-image-verify.png?>" alt="" class ="account-img">
                            <div class="verify-icon">
                                <i class="far fa-check-circle verified"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row verify-form-container hide" id ="verify-form-container">
            <div class="col-12">
                <div class="bg-danger p-3 mb-4">
                    <h3 class="text-white">
                        <?=Yii::t('main',' Please Be careful')?>

                    </h3>
                    <p class="text-white">
                        <?=Yii::t('main',' Be very accurate while entering your information they all should match
                        the information that your ID card holds.
                        Please don\'t be worry about your information, we care about your privacy,
                        all of your information will be used only to verify you, we don\'t share your
                        information with anyone.')?>

                    </p>
                </div>
            </div>
            <div class="col-12">
                <?php $form = ActiveForm::begin([
                    'action' => Url::to(['/upload/verifyuser']),
                    'options' => [
                        'class' => 'verify-form',
                        'enctype' => 'multipart/form-data',
                    ]
                ]); ?>
                <!--                --><?//= $form->field($data['verify'],'user_id',['options' => ['value' =>'0']])->hiddenInput()->label(false); ?>
                <?= $form->field($data['verify'],'name_ar', [
                    'template'=>

                        '<div class="input-group">
                             <div class="input-group-prepend">
                                  <div class="input-group-text">'. Yii::t("main", "Name in arabic").'
                                  </div>
                             </div>
                          {input}
                      </div>
                           {error}'
                ]); ?>
                <?= $form->field($data['verify'],'name_en', [
                    'template'=>

                        '<div class="input-group">
                             <div class="input-group-prepend">
                                  <div class="input-group-text">'. Yii::t("main", "Name in English").'
                                  </div>
                             </div>
                          {input}
                      </div>
                           {error}'
                ]); ?>

                <div class="form-row" style="margin-left: 0px !important; justify-content: space-between;">
                    <?= $form->field($data['verify'],'national_number', [

                        'template'=>

                            '
                                <div class="input-group">
                             <div class="input-group-prepend">
                                  <div class="input-group-text">'. Yii::t("main", "National Number").'
                                  </div>
                             </div>
                          {input}
                      </div>
                           {error}
                            '


                    ]); ?>

                    <?= $form->field($data['verify'],'sex', [

                        'template'=>

                            '
                                <div class="input-group">
                             <div class="input-group-prepend">
                                  <div class="input-group-text">'. Yii::t("main", "Sex").'
                                  </div>
                             </div>
                          {input}
                      </div>
                           {error}
                            '
                    ])->dropDownList(['m' => Yii::t('main','Male') , 'f' =>  Yii::t('main','Female')]); ?>
                    <?php
                    $date_now = time();
                    $olderthan18 = date('Y-m-d',strtotime('-18 years',strtotime(date('Y-m-d',$date_now))));
                    echo $form->field($data['verify'], 'birth_date' ,['template'=>

                        '
                                <div class="input-group">
                             <div class="input-group-prepend">
                                  <div class="input-group-text">'. Yii::t("main", "Birth Day").'
                                  </div>
                                   {input}
                             </div>
                         
                      </div>
                           {error}
                            '
                    ])
                        ->widget(DateTimePicker::classname(), [
                            'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                            'name' => 'dp_3',
                            'options' => [
                                'placeholder' => \Yii::t("main","Enter your birthday"),
                                'autoComplete' => 'off',

                            ],
                            //'convertFormat' => true,
                            'language' => "$language",

                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                                'endDate' => $olderthan18, //startDate Date. Default: Beginning of time The earliest date that may be selected; all earlier dates will be disabled.
                                'minView' => 3, // shows only date without hours or minutes, default is 0 which means user can select hours.
                            ]
                        ]);?>
                </div>
                <?= $form->field($data['verify'],'city_of_birth', [
                    'template'=>

                        '<div class="input-group">
                             <div class="input-group-prepend">
                                  <div class="input-group-text">'. Yii::t("main", "City of birth").'
                                  </div>
                             </div>
                          {input}
                      </div>
                           {error}'
                ]); ?>
                <?= $form->field($data['verify'],'mother_name', [
                    'template'=>

                        '<div class="input-group">
                             <div class="input-group-prepend">
                                  <div class="input-group-text">'. Yii::t("main", "Mother name").'
                                  </div>
                             </div>
                          {input}
                      </div>
                           {error}'
                ]); ?>
                <?= $form->field($data['verify'],'reg_num_place', [
                    'template'=>

                        '<div class="input-group">
                             <div class="input-group-prepend">
                                  <div class="input-group-text">'. Yii::t("main", "Registration number and place").'
                                  </div>
                             </div>
                          {input}
                      </div>
                           {error}'
                ]); ?>
                <?= $form->field($data['verify'],'place_issue', [
                    'template'=>

                        '<div class="input-group">
                             <div class="input-group-prepend">
                                  <div class="input-group-text">'. Yii::t("main", "Place of issue").'
                                  </div>
                             </div>
                          {input}
                      </div>
                           {error}'
                ]); ?>
                <?= $form->field($data['verify'],'place_residence', [
                    'template'=>

                        '<div class="input-group">
                             <div class="input-group-prepend">
                                  <div class="input-group-text">'. Yii::t("main", "Place of residence").'
                                  </div>
                             </div>
                          {input}
                      </div>
                           {error}'
                ]); ?>
                <?= $form->field($data['verify'],
                    'files[]',
                    ['template' =>     '<div class="input-group">
                             <div class="input-group-prepend">
                                  <div class="input-group-text">'. Yii::t("main", "ID photos").'
                                  </div>
                             </div>
     
                      </div>' . \Yii::t("main","Upload two photos of your ID from the front side and the back side, make sure that the picture is clear and readable.").'</p> {input}{error}{hint}',
                        //        'options' => ['class' => 'ward']
                    ])
                    ->fileInput(['Multiple'=> true ])?>
                <div id="selectedFiles"></div>
                <?= Html::submitButton('Submit' , ['class' =>'btn-dark-blue'] ) ?>
                <?php ActiveForm::end(); ?>
            </div>
            <?php       } ?>

        </div>
    </div>
   </div>
