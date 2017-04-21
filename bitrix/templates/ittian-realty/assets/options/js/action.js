$(document).ready(function() {
    $('.opt').click(function(){
        var par = $(this).parents('.options');
        var offset = par.offset();
        var bottom = $(window).height() - (par.height() + offset.top);
        if(par.hasClass('opened')){
            par.removeClass('opened');
            par.css('top', 42);
        }else{
			if(par.height() < $(window).height()){
				par.addClass('opened');
				par.addClass('opfixed');	
			}else{
				par.addClass('opened');						 
				par.css('top', offset.top);
			}
           
        }
    });

    $('.options input.checkbox').change(function(){
        document.location = $(this).data('url');
    });

    $(window).scroll(function() {
        var $win = $(window);
        var $par = $('.options.opened');
        if ($par.length && ($win.scrollTop() + $win.height() < $par.offset().top ||
            $win.scrollTop() > $par.offset().top + $par.innerHeight() )) {
            $par.removeClass('opened');
            $par.css('top', 42);
        }
    });

});