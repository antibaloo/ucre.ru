$(function(){

    $('.frm').click(function(){
        $(this).closest('.tg-forms').find('.inner-form').addClass('opened');
    });

    $('.close-fr').click(function(){
        $(this).closest('.inner-form').removeClass('opened');
    });

    $('.close-dn').click(function(){
        $(this).closest('.inner-done').removeClass('opened');
        $(this).closest('.tg-forms.back-form').find('.inner-form').show();
    });


    $('.tg-forms form').submit(function(){

        var $form = $(this);
        var $btn = $form.find('.button[type=submit]');
        var $wait = $form.closest('.inner-form').find('.wait');

        $form.ajaxSubmit({
            data: {
                forms_submit: 'submit',
                ajax: 1,
                PARAMS_HASH: $btn.data('hash')
            },
            dataType: 'json',
            type: 'post',
            beforeSubmit: function(){
                $btn.addClass('load');
                $form.find('input,textarea').removeClass('error');
                $wait.show();
            },
            success: function(result){
                if(result.result == 'error'){
                    $.each(result.errors,function(index, value){
                        $form.find('[name='+index+']').addClass('error');
                    });
                } else if(result.result == 'success'){
                    $form.trigger('reset');
                    if($form.find('.file_upload div').length > 0){
                        $form.find('.file_upload div').text('');
                    }

                    var $inner_form = $form.closest('.inner-form');
                    if($inner_form.hasClass('opened')){
                        $inner_form .removeClass('opened');
                    }else{
                        $inner_form.hide();
                    }


                    var $win = $(window);
                    var $done = $form.closest('.tg-forms').find('.inner-done');

                    $done.addClass('opened');

                    if($win.scrollTop() > $done.offset().top){
                        $('body,html').animate({
                            scrollTop: $done.offset().top-6
                        }, 500);
                    }
                }
                $btn.removeClass('load');
                $wait.hide();
            }
        });

        return false;
    });

});