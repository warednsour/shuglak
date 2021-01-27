    <?php

    use yii\bootstrap\Button;
    use yii\bootstrap\Modal;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    use kartik\rating\StarRating;

    ?>

<div class="container">
    <div class="job-offer">
        <div class="job-information" id="<?= $data['model']->id ?>">
            <p class="job-offer-details"><?=\Yii::t('main','Job details')?></p>
            <hr>
            <div class="job-offer-header">
                <div class="job-title">
                    <h1><?= $data['model']->title; ?></h1>
                </div>
                <div class="job-offer-expire-date">
                    <p>
                        <?= \Yii::t('main','Bidding on this Job ends in')?>
                    </p>
                    <p id="demo"></p>
                  <span id ="expire-date"class="<?= $data['model']->expire_date ?>"></span>
                </div>
            </div>

            <hr>
            <div class="job-offer-description">
                <h2><?= $data['model']->description; ?></h2>
            </div>

            <div class="job-offer-pay">
                <h2><?= $data['model']->pay; ?> JD</h2>
            </div>

            <h2><?= $data['model']->place; ?></h2>
            <h2><?= $data['model']->category; ?></h2>
            <h2><?= $data['model']->howlong; ?></h2>
            <h3> <?= $data['model']->views; ?><i class="fas fa-eye"></i>Views</h3>
            <div class="job-offer-published-at">
                <span><?= Yii::t('main','Published at: ') . $new_date = date('Y-m-d', strtotime($data['model']->create_date)); ?></span>
            </div>
        </div>
        <div class="employer-details">
            <p class="employer"><?= \Yii::t('main','About the employer')?></p>
        </div>
    </div>


    <h1>Hello there from show job</h1>

        <!--The job id and the user id should be  -->
        <h2>Job id = </h2>

    <br>


    <h3>The author information</h3>
    <h1></h1>
    <h3><?php
        if (isset($data['model']['author'])) {
            echo $data['model']['author']->getAuthorname();
        } else {
            echo 'New user';
        }
        ?></h3>
    <p>write a message to the author:</p>
    <?php if ($data['bidStatus']->status == 0) { ?>
        <?php if (!Yii::$app->user->isGuest && $data['model']->user_id != Yii::$app->user->getId()) { ?>
            <?php if (Yii::$app->user->identity) { ?>
                <a class="btn btn-info " data-toggle="modal" data-target="#writeNewMsg">Write Message</a>

            <?php } ?>

        <?php } ?>

    <?php } ?>


    <?php
    //if(Yii::$app->session->setFlash('MessageSuccess')){
    //    $success = 'Thank you for sending a message';
    //}
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
            'Send',
            [
                'id' => 'writeNewMsgSend',
                'class' => 'btn btn-primary',
                'onClick' => 'hideMsgSend()',
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

            'id' => 'dialog_footer-form',
            'action' => Url::to(['/ajax/message']),
        ]
    );

    foreach ($data['bidders'] as $bidder) {
        $new_receiver = $bidder->user_id;
    };
    var_dump($bidder->user_id);
    var_dump($new_receiver);
    if ($data['model']['author']->user_id == Yii::$app->user->getId()) {
        $receiver = $new_receiver;
        var_dump($new_receiver);
        var_dump($receiver);
    } else {
        $receiver = $data['model']['author']->user_id;
    };

    echo $form->field($data['message'], 'title')->textInput(['value' => '', 'placeholder' => 'write your title here', 'id' => 'dialog_footer-title'])->label('Title');
    echo $form->field($data['message'], 'text')->textarea(['rows' => '3', 'id' => 'message_footer-content'])->label('Message');
    echo $form->field($data['message'], 'receiver_id')->HiddenInput(['value' => $receiver, 'id' => $receiver, 'class'=>'receiver'])->label(false);
    echo $form->field($data['message'], 'sender_id')->HiddenInput(['value' => Yii::$app->user->getId(), 'id' => Yii::$app->user->getId(),'class'=>'sender'])->label(false);
    //echo $form->field($data['message'], 'dialog_id')->HiddenInput(['value' => 0, 'id' => 'dialog_footer-dialog_id'])->label(false);


    ActiveForm::end();

    Modal::end();
    ?>


    <h5>Placing a bid</h5>
    <style>
        .hidden {
            display: none;
        }

        #jobid {
            display: none;
        }

        #BidForm {
            display: none;
            width: 300px;
            border: 1px solid #ccc;
            padding: 14px;
            background: #ececec;
        }

        .new__bid__alert {
            display: none;
        }
    </style>


    <?php
    if ($data['model']->user_id == Yii::$app->user->getId()) {
        echo "you can't apply for your own job<br>";
    } else if ($data['bidStatus']->job_id == $data['model']->id) {
        echo "you can't apply twice for the job";
    } else {

        echo Button::widget(['label' => 'Place A bid', 'options' => ['class' => 'btn-lg', 'id' => 'ShowBidForm']]);
        $form = ActiveForm::begin([
            'action' => Url::to(['/ajax/addbid']),
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'method' => 'POST',
            'options' => ['class' => '', 'id' => 'BidForm']
        ]) ?>
        <?php $jobId = $data['model']->id;
        $userIdOfBid = Yii::$app->getUser()->id;
        ?>
        <?= $form->field($data['bid'], 'job_id')->hiddenInput(['value' => $jobId, 'id' => 'jobid','class' => $jobId])->label(false); ?>
        <?= $form->field($data['bid'], 'user_id')->hiddenInput(['value' => $userIdOfBid, 'id' => 'userid', 'class'=> $userIdOfBid])->label(false); ?>
        <?= $form->field($data['bid'], 'title')->textInput(['placeholder' => 'write your title here', 'id' => 'title']); ?>
        <?= $form->field($data['bid'], 'description')->textInput(['placeholder' => 'write your description here', 'id' => 'description']); ?>
        <?= $form->field($data['bid'], 'paid')->textInput(['placeholder' => 'write how much are you going to get paid', 'id' => 'paid']); ?>
        <?= Html::submitButton('I want this JOB!', ['class' => 'btn btn-block btn-danger', 'id' => 'SubmitBid']) ?>
        <?php ActiveForm::end() ?>

        <div class="new__bid__alert alert-success alert">
            <p>THANK YOU FOR BIDDING FOR THIS JOB PLEASE NOW WAIT YOU WILL GET AN ANSWER SOON!</p>
        </div>
    <?php } ?>
    <?php


    if ($data['bidStatus']->status == 0) {
        echo "now please wait the job offerer will contact you soon for your job status";
     //   echo $this->render('chat.php');
    }


    //if(!Yii::$app->user->isGuest && )?>

    <hr style="width: 100%; color: black; height: 1px; background-color:black;">
    <h1>People who all ready made bids on this job!</h1>
    <?php
    if (!Yii::$app->user->isGuest && Yii::$app->user->identity) {
        foreach ($data['bidders'] as $bidder) {
            $idBidder = $bidder->id;
            echo $idBidder;
            echo $bidder->title . "<br>";
            echo $bidder->description . "<br>";
            echo $bidder->paid . "<br>";
            echo $bidder->job_id . "<br>";
            echo $bidder->user_id . "<br>";
            echo $bidder->status . "<br>";
            if (!Yii::$app->user->isGuest && $data['model']->user_id == Yii::$app->user->getId()) {
                if (Yii::$app->user->identity) { ?>
                    <button
                            class="btn btn-info "
                            data-toggle="modal" data-target="#writeNewMsg">Write Message to bidder
                    </button>

                    <?php if ($bidder->status == 0) { ?>
                        <button id="hire" class="btn btn-outline-dark btn-group-sm btn-danger hireHim"
                                value="<?= $idBidder ?>" formmethod="post"> hire him
                        </button>
                    <?php } elseif ($bidder->status == 1) { ?>
                        <div class="row">
                            <div class="col-md-4">
                                <button id="jobDone" class="btn btn-outline-dark btn-group-sm btn-danger jobDone"
                                        value="<?= $idBidder ?>" formmethod="post">The job is done
                                </button>
                                <button id="jobNot" class="btn btn-outline-dark btn-group-sm btn-danger jobNot"
                                        value="<?= $idBidder ?>" formmethod="post"> The job was not complited
                                </button>
                            </div>
                        </div>
                    <?php } elseif ($bidder->status == 2 || $bidder->status == 3) { ?>
                        <div class="row">
                            <div class="col-md-4">
                                <button id="jobDone" data-toggle="modal" data-target="#review" class="btn btn-dark btn-group-sm btn-block feedback"
                                        value="<?= $idBidder ?>" formmethod="post">leave a review please!
                                </button>
                            </div>
                        </div>
                    <?php
                    }
                }
            }
                 }

            }
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

    foreach ($data['bidders'] as $bidder) {
        $new_receiver = $bidder->user_id;
    };


    if ($data['model']['author']->user_id == Yii::$app->user->getId()) {
        $receiver = $new_receiver;
    } else {
        $receiver = $data['model']['author']->user_id;
    };

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

    <?php


    $url = Url::to(['/ajax/addbid']);
    $userId = Yii::$app->user->getId();
    $hireUrl = Url::to(['ajax/bidstatusaccepted']);
    $csrfToken = Yii::$app->request->csrfToken;
    // basic/web?=ajax/addbid
    $reviewUrl = Url::to(['ajax/review']);
    $doneUrl = Url::to(['ajax/bidstatusdone']);
    $notUrl = Url::to(['ajax/bidstatusnot']);

    $this->registerJs(" 
    
    
    // to show the form of add a bid to this job
    
    $(document).ready(function(){
    
    
    
    // Count down for expire date
        var expire_date = $('#expire-date').attr('class');
        var date_object = new Date();
        date_object.setTime(Date.parse( expire_date ));
        
        // Set the date we're counting down to
        var countDownDate = date_object.getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {
        
            // Get today's date and time
            var now = new Date().getTime();
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
            
            if (!isNaN(distance)) {
              // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
            if(days > 3) {
                $('#demo').css('color', '#28a745');
            }
            if(days >= 1 && days < 3){
                $('#demo').css('color', '#ffc107');
            }
            if(days < 1 || isNaN(distance)){
                $('#demo').css('color', '#a71d2a');
            }
            // Output the result in an element with id=\"demo\"
            document.getElementById(\"demo\").innerHTML = days + \"d \" + hours + \"h \"
                + minutes + \"m \" + seconds + \"s \";
        
            // If the count down is over, write some text
            if (distance < 0 || isNaN(distance)) {
              $('#demo').css('color', '#a71d2a');
                clearInterval(x);
                document.getElementById(\"demo\").innerHTML = \"EXPIRED\";
            }
            } else if (isNaN(distance)) {
              $('#demo').css('color', '#a71d2a');
                clearInterval(x);
                document.getElementById(\"demo\").innerHTML = \"EXPIRED\";
            }
        }, 1000);

        $('#ShowBidForm').click(function(){
            $('#BidForm').toggle(500);
            
      });
    });
    
   
    
    //Ajax to review submit
    $('#reviewSend').on('click',function(event)
    {
        event.preventDefault();
        if($('#review_footer-content').val() !=''){
            $('#review').modal('hide');
            $.ajax({
            url : '$reviewUrl',
            type : 'POST',
            dataType: 'json',
            data: {
            'review_title' : $('#review_footer-title').val(),
            'review_content' : $('#review_footer-content').val(),
            'reviewed_id' : $('.reviewed_id').attr('value'),
            'reviewer_id' : $('.reviewer_id').attr('value'),
            'job_id' : $('.job_id').attr('value'),
            '_csrf' : '$csrfToken',
     //       'rating' : $('.rating').attr('value'),
            },
            success: function(data) {
               location.reload(true);
            }
        }); 
        
      } else {
        alert('please contact webmaster');
      }
    });
    
    
    //Ajax to update the status of bid ( Done , status = 2 )
    
    $('.jobDone').on('click',function()
    {
       // $('.hireHim').hide(200);
        $.ajax({
        url : '$doneUrl' + '?id='+ $(this).attr('value'),
        type: 'POST',
        dataType: 'json',
        data: {
        'id' : $(this).attr('value'),
        },
        success: function(data) {
            $('.hireHim').hide(200);
            }, 
    });
    })
    
    
    //Ajax to update the status of bid ( Not done , status = 3 )
    
    $('.jobNot').on('click',function()
    {
     //   $('.jobNot').hide(200);
        $.ajax({
        url : '$notUrl' + '?id='+ $(this).attr('value'),
        type: 'POST',
        dataType: 'json',
        data: {
        'id' : $(this).attr('value'),
        },
        success: function(data) {
            $('.hireHim').hide(200);
            }, 
    });
    })
    
    //Ajax to update the status of the bid ( accepted , status = 1)
    
    $('.hireHim').on('click',function()
    {
    
        $.ajax({
        url : '$hireUrl' + '?id='+ $(this).attr('value'),
        type: 'POST',
        dataType: 'json',
        data: {
     //   'csrfTokenName': '$csrfToken',
        'id' : $(this).attr('value'),
        },
        success: function(data) {
            $('.hireHim').hide(200);
            }, 
    });
    })
    
    
    // To hide the Message model
    
    var titleField = document.querySelector('#dialog_footer-title').value;
    var messageField = document.querySelector('#message_footer-content').value;
    function hideMsgSend() {
       if(titleField && messageField){
        document.querySelector('#writeNewMsg').modal('hide');
    }
    }
    
    $('#writeNewMsgSend').on('click',function(event)
    {
        event.preventDefault();
        if($('#message_footer-content').val() !=''){
            $('#writeNewMsg').modal('hide');
            $.ajax({
            url : $(this).attr(' action '),
            type : 'POST',
            dataType: 'json',
            data: {
            'title' : $('#dialog_footer-title').val(),
            'text' : $('#message_footer-content').val(),
            'receiver_id' : $('.receiver').attr('value'),
            'sender_id' : $('.sender').attr('value'),
            },
            success: function(data) {
                $('.new__bid__alert').show(200);
            }
        }); 
        
        } else {
        alert('please contact webmaster');
        }
    });
    
    // Ajax to add a bid on this Job
    
    $('#SubmitBid').on('click',function() {
              event.preventDefault(); // to prevent the submit from happening twice
           if($('#description').val()!='') {
               $('#BidForm').toggle(500);
             $('.new__bid__alert').css('display','block');
             $('#ShowBidForm').css('display','none');
            $.ajax({
                url: $(this).attr( 'action' ),
                type: 'POST',
                dataType: 'json',
                data: {
                    'title': $('#title').val(),
                    'description': $('#description').val(),
                    'paid': $('#paid').val(),
                    'user_id': document.querySelector('#userid').attributes.class,
                    'job_id': document.querySelector('.job-information').attributes.id,
                }, 
                success: function(data) {
     //           alert('the request were sent');
                    $('.new__bid__alert').show(200);
                 //   $('.new_comment').hide(200);
                //  window.location.href += '#comments';
                 //   location.reload();
                }
            
            });
            
        } else {
            alert('something went wrong please check your code!')
          //  $(this).closest('.new_bid').addClass('has-error');
        }
        
    });
    
    
    
    
    "); ?>
