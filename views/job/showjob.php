<?php
    use yii\helpers\Url;
    ?>

<div class="container">
    <?php
    #The job offer
   echo $this->render('job-offer.php',compact('data'));

   #Send Messages
    if (($data['userIsEmployeer'] !== true) && $data['currentUserHiredForJob'] ) {
         echo $this->render('write-message.php' , compact('data'));
     }

    #Place Bid on the job
   if (($data['userIsEmployeer'] !== true) && ($data['currentUserMadeBid'] === true)) {
        echo \Yii::t('main','Now please wait until the employer hires you.');
    } elseif ($data['userIsEmployeer'] !== true) {
        echo $this->render('place-bid.php',compact('data'));
    }

    #List of bids on this job
   echo $this->render('bidders.php',compact('data'));


    $url = Url::to(['/ajax/addbid']);
    $userId = Yii::$app->user->getId();
    $hireUrl = Url::to(['ajax/bidstatusaccepted']);
    $csrfToken = Yii::$app->request->csrfToken;
    // basic/web?=ajax/addbid
    $reviewUrl = Url::to(['ajax/review']);
    $doneUrl = Url::to(['ajax/bidstatusdone']);
    $notUrl = Url::to(['ajax/bidstatusnot']);
    $messageUrl = Url::to(['ajax/message']);

    $this->registerJs(" 
    
    
    // to show the form of add a bid to this job
    
  
    
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
    
//    $('#writeNewMsgSend').on('click',function(event)
////    {
////        event.preventDefault();
////        if($('#message_footer-content').val() !=''){
////            $('#writeNewMsg').modal('hide');
////            $.ajax({
//////            url : $(this).attr(' action '),
////            url: '$messageUrl',
////            type : 'POST',
//////            dataType: 'json',
////            data: {
////            'title' : $('#dialog_footer-title').val(),
////            'text' : $('#message_footer-content').val(),
////            'receiver_id' : $('.receiver').attr('value'),
////            'sender_id' : $('.sender').attr('value'),
////            },
////            success: function(data) {
////                $('.new__bid__alert').show(200);
////            }
////        }); 
////        
////        } else {
////        alert('please contact webmaster');
////        }
////    });
    
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
