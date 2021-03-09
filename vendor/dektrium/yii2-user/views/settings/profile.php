<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use dektrium\user\helpers\Timezone;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use budyaga\cropper\Widget;
use yii\helpers\Url;
use kartik\select2\Select2;
/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $model
 */

$this->title = Yii::t('user', 'Profile settings');
//$this->params['breadcrumbs'][] = $this->title;
$categoryTitle = 'title_' . Yii::$app->language;
$cityName = 'city_' . Yii::$app->language;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?//= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'profile-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                ]); ?>
                <?php
                echo $form->field($model, 'photo')->widget(Widget::className(), [
                    'uploadUrl' => Url::toRoute('/ajax/change-avatar'),
                    'aspectRatio'=>1,
                ])
                ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'company_name') ?>
                <?= $form->field($model, 'public_email') ?>
                <?= $form->field($model, 'telephone_number') ?>
<!--                --><?//= $form->field($model, 'fav_categories',[
//                        'options' => ['class' => 'selectpicker' , 'data-max-option ="3"'],
//                        'template' =>
//                    '{label}<p class="sub-label">' . \Yii::t("main","Let it be Uniqe!").'</p> {input}{error}{hint}'
//                ])->dropDownList(ArrayHelper::map($categories,'id',"$categoryTitle"),['prompt'=>\Yii::t("main","Select a category"), 'multiple'=>'multiple',]) ?>
<!--                --><?php
                echo '<label class="control-label">'.\Yii::t("main","Favorite Categories").'</label>';
                echo $form->field($model,'fav_categories')->widget(Select2::className(),[
                    'language' => Yii::$app->language,
                    'name' => 'fav_categories',
                    'data' => ArrayHelper::map($categories,'id',"$categoryTitle"),
                    'maintainOrder' => true,
                    'options' => ['placeholder' => \Yii::t("main","Select a category"), 'multiple' => true],
                    'pluginOptions' => [
                        'tags' => true,
                        'maximumInputLength' => 2,
                        'maximumSelectionSize' => 3,
                        'maximumSelectionLength' => 3,
                        'size' => 3,
                    ],
                ]);
                ?>
                <?= $form->field($model, 'city')->dropDownList(ArrayHelper::map($cities,'id',"$cityName"), ['prompt'=>'Select...']) ?>
                <?= $form->field($model, 'bio')->textarea() ?>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-block btn-success crop-photo']) ?>
                        <br>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
