
//        show more category on main filter          //
$('.show-more-category').on('click', function () {
    if($('.category-list li').hasClass('hide')){
        $(this).html('Show Less');
        $('.category-list li').removeClass('hide');
    } else {
        $(this).html('Show More');
        $('.category-list li').each(function (index) {
            if(index > 3) {
                $(this).addClass('hide');
            }
        });
    }
});


// show more City on main filter //
$('.show-more-city').on('click', function () {
    if($('.city-list li').hasClass('hide')){
        $(this).html('Show Less');
        $('.city-list li').removeClass('hide');
    } else {
        $(this).html('Show More');
        $('.city-list li').each(function (index) {
            if(index > 3) {
                $(this).addClass('hide');
            }
        });
    }
});


// Count charachters remained

$('#job-description').on('keyup',function () {
    $('.counter-container').show();
    let textCount = $(this).val().length;
    let counter = $('.counter-text');
    let span  = $('.counter-container > span');
    counter.text(255 - textCount);
    if(textCount == 255) {
        counter.css('color', '#dc3545');
        span.css('color', '#dc3545');
    } else {
        counter.css('color' , '#03293c');
        span.css('color' , '#03293c');
    }
});


// Remove files after select on Job offer Form

$(document).ready(function() {
    $("#job-file").on("change", handleFileSelect);
    selDiv = $("#selectedFiles");
    // $("#myForm").on("submit", handleForm);
    $("body").on("click", ".selFile", removeFile);
});
let urlAddJob = document.location.toString();
if(urlAddJob.match('addjob') != null) {
let selDiv = "";
// let selDivM="";
let storedFiles = [];

function handleFileSelect(e) {
    let files = e.target.files;
    let filesArr = Array.prototype.slice.call(files);
    let device = $(e.target).data("device");
    filesArr.forEach(function(f) {
        // if (!f.type.match("image.*")) {
        //     return;
        // }
        storedFiles.push(f);
        let reader = new FileReader();
        reader.onload = function(e) {
            // let html = "<div><img src="" + e.target.result + "" data-file='" + f.name + "' class='selFile' title='Click to remove'>" + f.name + "<br clear="left"/></div>";
            $("#selectedFiles").append(html);
        }
        reader.readAsDataURL(f);
    });
}
}
// function handleForm(e) {
//     e.preventDefault();
//     let data = new FormData();
//     for (let i = 0, len = storedFiles.length; i < len; i++) {
//         data.append('Job[file][]', storedFiles[i]);
//     }
//     let xhr = new XMLHttpRequest();
//     xhr.open('POST', 'handler.cfm', true);
//     xhr.onload = function(e) {
//         if (this.status == 200) {
//             console.log(e.currentTarget.responseText);
//             alert(e.currentTarget.responseText + ' items uploaded.');
//         }
//     }
//     xhr.send(data);
// }
function removeFile(e) {
    let file = $(this).data("file");
    let files = $('#job-file').prop('files');
    for (let i = 0; i < storedFiles.length; i++) {
        console.log(file);
        console.log(files[i].name);
        if (files[i].name === file) {
            delete files[1];
            storedFiles.splice(i, 1);
            break;
        }
    }
    $(this).parent().remove();
}


// Account settings Pills
$('#v-pills-tab a').on('click', function (e) {
    e.preventDefault();
    $(this).tab('show')
})

//Redirect user to the choosen PILL - Account from settings or settings to account
let url = document.location.toString();
let whereTo = url.split('#')[1];
if (url.match('#') && url.match('pills')) {
    $('#pills-account-tab').removeClass('active');
    $('#pills-account-tab').attr('aria-selected' , 'false');
    $('#pills-account').removeClass('show');
    $('#pills-account').removeClass('active');
    $('#'+whereTo +'-tab').addClass('active');
    $('#' +whereTo + '-tab').attr('aria-selected','true');
    $('#'+whereTo).addClass('show');
    $('#'+whereTo).addClass('active');
}


// Count down for expire date
let expire_date = $('#expire-date').attr('class');
let date_object = new Date();
date_object.setTime(Date.parse( expire_date ));

// Set the date we're counting down to
let countDownDate = date_object.getTime();

// Update the count down every 1 second
let x = setInterval(function() {

    // Get today's date and time
    let now = new Date().getTime();
    // Find the distance between now and the count down date
    let distance = countDownDate - now;

    if (!isNaN(distance)) {
        // Time calculations for days, hours, minutes and seconds
        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if(days > 3) {
            $('#demo').css('color', '#28a745');
        }
        if(days >= 1 && days < 3){
            $('#demo').css('color', '#ffc107');
        }
        if(days < 1 || isNaN(distance)){
            $('#demo').css('color', '#a71d2a');
        }
        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0 || isNaN(distance)) {
            $('#demo').css('color', '#a71d2a');
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    } else if (isNaN(distance)) {
        $('#demo').css('color', '#a71d2a');
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);

$('#ShowBidForm').click(function(){
    $('#BidForm').toggle(500);

});



//Send message
$('#writeNewMsgSend').on('click',function (event) {
    if($('#dialog_footer-title').val() !== '' && $('#message_footer-content').val() !== '') {
        // var data = ;
        var url = '/basic/web/ajax/message/';
         // console.log($('#message-form').serializeArray());
        $.ajax({
            url: url,
            // contentType: "application/json",
            type: 'POST',
            // dataType: 'json',
            data: $('#message-form').serializeArray(),
            // data: {
            //     'title' : $('#dialog_footer-title').val(),
            //    'text' : $('#message_footer-content').val(),
            //    'receiver_id' : $('.receiver').attr('value'),
            //    'sender_id' : $('.sender').attr('value'),
            // },
        })
            .done(function(response) {
                console.log("Wow you commented" + response);
            })
            .fail(function(jqXHR, textStatus, error) {
                console.log("error" + error);
                console.log("jqXHR" + jqXHR);
                console.dir(jqXHR);
                console.log("textStatus" + textStatus);
            });
    }

}).on('submit',function (e) {
    e.preventDefault();
    console.log(e)
});

//Place a bid
$('#placeBidNow').on('click',function (e) {
        let bidContainer = $('.place-bid-container');
        let paidField = $('#paid').val();
        let bidForm =  $('#bidForm');
        let description = $('#description').val();
        let title = $('#title').val();
        if(description !== "" &&  title !== "" && !isNaN(paidField)) {
            $.ajax({
                url: bidForm.attr('action'),
                type: 'POST',
                data: bidForm.serializeArray(),
                dataType: 'json',
            })
                .done(function(response) {
                    bidContainer.toggle(500);

                })
                .fail(function(jqXHR, textStatus, error) {
                    alert('Please contact a web master');
                    console.log("error" + error);
                    console.log("jqXHR" + jqXHR);
                    console.dir(jqXHR);
                    console.log("textStatus" + textStatus);
                }
            );

        } else {

        }

        });
        // if(isNaN(paidField.val()) || paidField.val() !== ''){
        //    return;
        // }

$('#bidForm').on('beforeSubmit',function (e) {
    e.preventDefault();
});

// $('#writeNewMsgSend').on('click',function(event)
// {
//     // event.preventDefault();
//     if($('#message_footer-content').val() !==''){
//         $('#writeNewMsg').modal('hide');
//         $.ajax({
//             url: '/basic/web/ajax/message',
//             type : 'POST',
//             dataType : 'json',
//             data: {
//                 'title' : $('#dialog_footer-title').val(),
//                 'text' : $('#message_footer-content').val(),
//                 'receiver_id' : $('.receiver').attr('value'),
//                 'sender_id' : $('.sender').attr('value'),
//             },
//             success: function(data) {
//                 $('.new__bid__alert').show(200);
//             }
//         });
//
//     } else {
//         alert('please contact webmaster');
//     }
// });


//Redirect user in Job list to the job when clicked

$('.responses-table-row').on('click',function (){
    let target = $(this).find('.bloko-link');
    window.location.href = target.attr('href')
})

//Showing the verification form
$('.verify-start').on('click',function(){
    let form = $('#verify-form-container');
    form.slideToggle("slow");
    // Store hash

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
        scrollTop: $(form).offset().top
    }, 800, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = form;

    })
})



//Filter main page search
$(document).ready(function(){
        
        
    var page = 0;
     
     $('#loading').hide();    
     filter_data();

     function get_filter(class_name)
     {
     var filter = [];
     $('.'+class_name+':checked').each(function(){
         filter.push($(this).val());
     });
     return filter;
    }

    function filter_data() {
           $.ajax({
             url : '/basic/web/ajax/filter/' + '?page=' + page,
             type : 'GET',
             data: {
                'keyword' : $('#keyword').val(),
                'city' : get_filter('city'),
                'category': get_filter('category'),
                'pay' : $('#paid').val(),
                 },
                //  beforeSend: function(){
                // },
                   success:function(data){
                    $('.filter_data').html(data);
                   }
       
            })
    }
    
 $('.common_selector').click(function(){
     filter_data();
 });
 
 $('#keyword').on('keyup',function(){
           filter_data();
    })
$('select').on('change',function(){
    filter_data();
})
  $('#filter').on('click',function(){
       page++;  
     filter_data()
     })

function ready() {
 $('#loading').fadeOut();
}

$('#loadMore').on('click',function(){
     page++;
     $('#loadMore').fadeOut(900);
     $('#loading').show(900);
     filter_data();
      $('#loading').fadeOut(900);
     $('#loadMore').fadeIn(900);
     });
})

 $('#allcities').hover(function(){
     
     $(this).children('option').stop(true,false,true).slideToggle(400);
 })
 
 

