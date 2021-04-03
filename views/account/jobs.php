<?php
use app\models\cities;
use yii\helpers\Url;
?>
<div class="tab-pane fade" id="pills-jobs" role="tabpanel" aria-labelledby="pills-contact-tab">
    <?php

    if(count($data['jobs']) > 0){ ?>
        <div class="container  pt-4">


                    <h3><?= \Yii::t('main','This is a list of the jobs you have offered')?></h3>
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
                       <?= \Yii::t('main','Job')?>
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


     <?php foreach ($data['jobs'] as $job){?>
     <tr class="responses-table-row">
                    <td class="responses-table-row__cell">
                        <label class="bloko-checkbox">
                            <span class="bloko-checkbox__text">
                                <span class="responses-table-status">
                                    <a class="bloko-link-switch bloko-link-switch_secondary" data-qa="negotiations-sort false" href="">
                                        <span>
                                            <?php
                                                $bidsNumber = count(\app\models\Bids::getBidsForJob($job->id));
                                            if ($bidsNumber > 0){
                                                echo $bidsNumber . Yii::t('main',' People Applied');
                                            } else {
                                                echo Yii::t('main','No one has applied yet for Job');
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
                        <a class="bloko-link" target="_blank" data-qa="negotiations-item-vacancy" href="<?= Url::to(['job/showjob', 'link' => $job->link])?>"><?=$job->title?></a>
                        <div class="responses-table-row__employer">
                            <?= \Yii::t('main','In')?>
                            <span data-qa="negotiations-item-company">
                               <?= Cities::getCityName($job->place)?>
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
                                <?= date("d  F Y", strtotime($job->create_date)) ?>
                            </span>
                        </div>
                    </td>
                    <td class="responses-table-row__cell responses-table-row__cell_vacancy-status responses-table-row__cell_nowrap"></td>
                    <td class="responses-table-row__cell responses-table-row__cell_date responses-table-row__cell_nowrap"><span class="responses-table-date" data-qa="negotiations-item-date"> <?= date("d  F Y", strtotime($job->create_date)) ?></span></td>
     </tr>
<!--            <div class="job">-->
<!--                <p class="job-title"> --><?//=$job->title?><!--</p>-->
<!--                <a href="--><?//= Url::to(['job/showjob', 'link' => $job->link])?><!--">--><?//= \Yii::t('main','Show Job')?><!--</a>-->
<!--            </div>-->

        <?php   }?>

            </tbody>
           </table>
            <a href="<?= Url::to(['job/addjob'])?>">
                <button class="btn-block btn-dark-blue" style="margin-top: 40px; margin-bottom: 40px;">
                        <?= Yii::t('main','Add a new Job')?>
                </button>
            </a>

        </div>
        </div>

            <?php } else { ?>
        <h3><?= \Yii::t('main','What are you waiting for?')?></h3>
        <h5><?= \Yii::t('main','Post A Job and hire one of the best people around you!')?></h5>
    <?php }?>
</div>
