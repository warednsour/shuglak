<?php

use app\models\Job;
use yii\helpers\Url;
?>

<div class="tab-pane fade" id="pills-bids" role="tabpanel" aria-labelledby="pills-contact-tab">
    <?php
    if(count($data['bids']) > 0){ ?>
        <div class="container pt-4">


            <h3><?= \Yii::t('main','This is a list of the bids you have made')?></h3>
            <div class="job-list">
                <table class="responses-table">
                    <thead >
                    <tr class="responses-table-header">

                        <th class="responses-table-header__cell">
                        <span class="responses-table-status">
                            <?= \Yii::t('main','Status')?>
                        </span>
                        </th>


                        <th class="responses-table-header__cell">
                        </th>

                        <th class="responses-table-header__cell">
                            <?= \Yii::t('main','Bid')?>
                        </th>

                        <th class="responses-table-header__cell">
                        </th>

                        <th class="responses-table-header__cell">
                        <span class="responses-table-status">
                            <?= \Yii::t('main','Date')?>
                        </span>
                        </th>
                    </tr>
                    </thead>


                    <tbody>


                    <?php foreach ($data['bids'] as $bid){?>
                        <tr class="responses-table-row">
                            <td class="responses-table-row__cell">
                                <label class="bloko-checkbox">
                            <span class="bloko-checkbox__text">
                                <span class="responses-table-status">
                                    <a class="bloko-link-switch bloko-link-switch_secondary" data-qa="negotiations-sort false" href="">
                                        <span>
                                            <?php
                                            $bidstatus = $bid->status;
                                            if ($bidstatus == 0){
                                                //bid status = 0 this means the user made a bid and the employer didn't hire him yet
                                                echo Yii::t('main','Reviewing');
                                            } elseif ($bidstatus == 1) {
                                                echo Yii::t('main','Hired');
                                            } elseif ($bidstatus == 2){
                                                echo Yii::t('main','Great! Job is Done');
                                            } elseif ($bidstatus == 3 ){
                                                echo Yii::t('main','Job was not Done');
                                            }?>
                                        </span>
                                        <span></span>
                                        <span></span>
                                    </a>
                                </span>
                            </span>
                                </label>
                            </td>
                            <td class="responses-table-row__cell responses-table-row__cell_icon"></td>
                            <td class="responses-table-row__cell responses-table-row__cell_vacancy">
                                <a class="bloko-link" target="_blank" data-qa="negotiations-item-vacancy" href="<?= Url::to(['job/showjob', 'link' => Job::getJobLink($bid->job_id)])?>"><?=$job->title?></a>
                                <div class="responses-table-row__employer">
                                    <?= $bid->title ?>

                                    <br>
                                    <span data-qa="negotiations-item-company">
                                   <?= \Yii::t('main','On')?>
                               <?= Job::getJobName($bid->job_id)?>
                            </span>
                                </div>

                                <div class="responses-table-row__vacancy-details">
                                    <div class="responses-table-actions-and-menu-container">
                                        <div class="responses-table-actions"><span class="responses-table-form">
<!--                                        <button type="button" class="responses-table-action" data-qa="negotiations-feedback"><?//php 'octav otziv'?></button>-->
                                    </span>
                                            <span class="responses-table-form"><button type="button" class="responses-table-action" data-qa="negotiations-vacancy_summary"><?//php 'Статистика по вакансии'?></button>
                                    </span>
                                        </div>
                                        <div>
                                        </div>
                                    </div>
                                    <span class="responses-table-date responses-table-date_show-on-xs">
                                <?= date("d  F Y", strtotime($bid->create_date)) ?>
                            </span>
                                </div>
                            </td>
                            <td class="responses-table-row__cell responses-table-row__cell_vacancy-status responses-table-row__cell_nowrap"></td>
                            <td class="responses-table-row__cell responses-table-row__cell_date responses-table-row__cell_nowrap"><span class="responses-table-date" data-qa="negotiations-item-date">
                                    <?= date("d  F Y", strtotime($bid->create_date)) ?>
                                </span>
                            </td>
                        </tr>
                    <?php   }?>

                    </tbody>
                </table>
                <a href="<?= Yii::$app->homeUrl ?>">
                    <button class="btn-block btn-dark-blue" style="margin-top: 40px; margin-bottom: 40px;">
                        <?= Yii::t('main','Bid on Jobs')?>
                    </button>
                </a>

            </div>
        </div>

    <?php } else { ?>
        <h3><?= \Yii::t('main','What are you waiting for?')?></h3>
        <h5><?= \Yii::t('main','Bid on Jobs and get hired of the best people around you!')?></h5>
    <?php }?>



</div>

