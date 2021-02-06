
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
    var textCount = $(this).val().length;
    var counter = $('.counter-text');
    var span  = $('.counter-container > span');
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
var selDiv = "";
// var selDivM="";
var storedFiles = [];

function handleFileSelect(e) {
    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);
    var device = $(e.target).data("device");
    filesArr.forEach(function(f) {
        // if (!f.type.match("image.*")) {
        //     return;
        // }
        storedFiles.push(f);
        var reader = new FileReader();
        reader.onload = function(e) {
            var html = "<div><img src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'>" + f.name + "<br clear=\"left\"/></div>";
            $("#selectedFiles").append(html);
        }
        reader.readAsDataURL(f);
    });
}

// function handleForm(e) {
//     e.preventDefault();
//     var data = new FormData();
//     for (var i = 0, len = storedFiles.length; i < len; i++) {
//         data.append('Job[file][]', storedFiles[i]);
//     }
//     var xhr = new XMLHttpRequest();
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
    var file = $(this).data("file");
    var files = $('#job-file').prop('files');
    for (var i = 0; i < storedFiles.length; i++) {
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
var url = document.location.toString();
var whereTo = url.split('#')[1];
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
