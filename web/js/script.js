
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
        })
    }
});


// show more City on main filter //