$(function(){

    $('.filters .sub-but').click(function(){

        $('#form_smart_filter .noselect').attr('disabled','disabled');

        $('#form_smart_filter').append('<input type="hidden" name="set_filter" value="Y">');

        $('#form_smart_filter').trigger('submit');

        return false;
    });

    $('.filters .filt-res').click(function(){

        $('#form_smart_filter .noselect').attr('disabled','disabled');

        $('#form_smart_filter').append('<input type="hidden" name="del_filter" value="Y">');

        $('#form_smart_filter').trigger('submit');

        return false;
    });

    $('.filters .dispafter').click(function(e){

        var $row = $(this).closest('.filt-row');

        if($row.hasClass('ch')){
            $row.find('input.checkbox').attr('checked',null);
        }else{
            $row.find('input').attr('disabled','disabled');
        }

        $row.find('.for-after').hide();

        $(this).closest('.filt-but.after').removeClass('after');

        $('#form_smart_filter .noselect').attr('disabled','disabled');

        $('#form_smart_filter').append('<input type="hidden" name="set_filter" value="Y">');

        $('#form_smart_filter').trigger('submit');

        return false;
    });

    $('.filters .min, .filters .max').change(function(){

        $(this).closest('.filt-row').find('.min,.max').removeClass('noselect');
    });




});