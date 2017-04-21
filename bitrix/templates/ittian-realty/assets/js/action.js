$(document).ready(function() {
	  document.createElement('header');
      document.createElement('section');
      document.createElement('footer');
      document.createElement('nav');
	  
	$('select').each(function(){	
		$(this).selectize({
			 create: true
		});
	});  
 $('input, textarea').placeholder();
	// top menu
	$('.t-nav>li').each(function(){
		if($(this).find('ul').length > 0){
			$(this).find('>a').append('<span></span>');
			if($(window).width() < 1025){
				 $(this).find('>a').click(function(){return false;});
			}
           
		}
	});   
	
	$('.t-nav>li>ul>li').each(function(){
		if($(this).find('ul').length > 0){
			$(this).find('>a').append('<span></span>');
			if($(window).width() < 1025){
				$(this).find('>a').click(function(){return false;});
			}
		}
	}); 

	function mainMenu(){
		if($('.bottom-head ul').height() > 70 && $(window).width() > 851){
			$('.bottom-head .wrapper').prepend('<a class="dottes"><span></span></a>');
		}
	}
	mainMenu();
	
	$('.dottes').click(function(){
		var item = $('.bottom-head');
		if(item.hasClass('opened')){
			item.removeClass('opened');
		}else{
			item.addClass('opened');
		}
		
	});
	  
	  
	// overflow для текста
	$('.slider .desc, .slider .title, .usl-item .title, .usl-item .desc, .sl a.item .adr, .nw-body, .alb-item .middle.des div span, sot-body').dotdotdot();
	

	$('.sert-wr .more').click(function(){
		var item = $(this).closest('.sert-wr');
		if(item.hasClass('opened')){
			item.removeClass('opened');
			//$(this).html('Показать все сертификаты и награды');
		}else{
			item.addClass('opened');
			//$(this).html('Скрыть все сертификаты и награды');
            $(this).hide();
		}
	});
	
	
	//открытие бокового меню
	$('.side-link').click(function(){
		var item = $('.sidebar');
		var yourClick = false;
		if (!item.hasClass('active')) {
			$('.sidebar').addClass('active');		
			$('body').addClass('shift');
			 $( ".main" ).animate({
					left: '265px'
				  }, 150 );
		}else{
			$('.sidebar').removeClass('active');
			$('body').removeClass('shift');
			$( ".main" ).animate({
				left: '0px'
			}, 150 );
			$(document).unbind('click.myEvent');
		}
		
		
		 $(document).bind('click.myEvent', function(e) {
				if (!yourClick && $(e.target).closest(item).length == 0) {
					$('.sidebar').removeClass('active');
					$('body').removeClass('shift');
					$( ".main" ).animate({
						left: '0px'
					}, 150 );
					
					// возвращаем всё в сайдбаре 
					$('.s-back').css('left', '-265px');
					$('.s-vision').removeClass('s-vision');
					$('.s-open').removeClass('third-open').removeClass('s-open');
			
			
					$(document).unbind('click.myEvent');
					return false;
				}
				yourClick = false;
			}); 
			
		
		
		return false;
	});
	
	// дропдаун бокового меню
	$('.sidebar li').each(function(){
		if($(this).find('ul').length > 0){
			$(this).prepend('<div class="s-ar"></div>');
			$(this).addClass('s-li')
		}
	});   
	
	$('.sidebar>ul>li.s-li>a').click(function(){
		var item = $(this).closest('ul');
		var title = $(this).closest('li').find('>a').html();
		 $(this).closest('li').addClass('s-vision');
		item.addClass('s-open');
		$('.s-back').css('left', 0)
		$('.s-back').html(title);
		$('.s-back').attr('data-last-title', title);
		return false;
	});
	
	$('.s-back').click(function(){
		var sitem = $(this).parent('.sidebar').find('.s-open');
		var thitem = $(this).parent('.sidebar').find('.third-open');
		if(thitem.length > 0){
			thitem.removeClass('third-open');
			$('.s-back').html($('.s-back').attr('data-last-title'));
		}else{
			sitem.removeClass('s-open')
			$('.s-back').css('left', '-265px');
			$('.s-vision').removeClass('s-vision');
		}
	});
	
	$('.sidebar>ul>li>ul>li.s-li>a').click(function(){
		$('.s-open').addClass('third-open');
		var title = $(this).closest('li').find('>a').html();
		$('.s-back').html(title);
		return false;
	});
	
	if($('.slider ').length > 0 ){
		if($('.slider li').length > 1){
		$('.slider').bxSlider({
			autoHover:true,
			infiniteLoop:true,
			pager:true,
			auto: true,
			controls:false
		});  
		}else{
			$('.slider').bxSlider({
				autoHover:true,
				infiniteLoop:false,
				pager:true,
				auto: true,
				controls:false
			});  
		}
	}
	
	
	
	if($('#spec-main').length >0){

        var item_count = $('#spec-main .item').length;

        var width = $(window).width(),
            maxSlides = 4,
            contr = true;
        if (width < 580) {
            maxSlides = 1;
            contr = true;
        } else if(width < 800){
            maxSlides = 2;
            contr = true;
        }  else if(width < 1050){
            maxSlides = 3;
            contr = true;
        }

        var specSlider = null;
        if(item_count > maxSlides) {
            var specSlider = $('.slider-spec .sl').bxSlider({
                autoHover: true,
                minSlides: 1,
                maxSlides: maxSlides,
                slideWidth: 232,
                infiniteLoop: true,
                pager: true,
                auto: false,
                controls: contr
            });
        }

        $( window ).resize(function() {
            if(specSlider){
                specSlider.destroySlider();
                specSlider = null;
            }
            var width = $(window).width();
            if (width < 580 && item_count > 1) {
                specSlider = $('#spec-main').bxSlider({
                    autoHover:true,
                    minSlides: 1,
                    maxSlides: 1,
                    slideWidth: 232,
                    infiniteLoop:true,
                    pager:true,
                    auto: false,
                    controls:true
                });
            } else if(width < 800 && item_count > 2){
                specSlider = $('#spec-main').bxSlider({
                    autoHover:true,
                    minSlides: 1,
                    maxSlides: 2,
                    slideWidth: 232,
                    infiniteLoop:true,
                    pager:true,
                    auto: false,
                    controls:true
                });

            }  else if(width < 1050 && item_count > 3){
                specSlider = $('#spec-main').bxSlider({
                    autoHover:true,
                    minSlides: 1,
                    maxSlides: 3,
                    slideWidth: 232,
                    infiniteLoop:true,
                    pager:true,
                    auto: false,
                    controls:true
                });
            }else if(item_count > 4){
                specSlider = $('#spec-main').bxSlider({
                    autoHover:true,
                    minSlides: 1,
                    maxSlides: 4,
                    slideWidth: 232,
                    infiniteLoop:true,
                    pager:true,
                    auto: false,
                    controls:true
                });
            }
        });
	}
	
	$('.slider li').each(function(){
		var bg = $(this).find('img').attr('src');
		$(this).css('background', 'url(../' + bg + ') 50% 50% no-repeat');
	});
	
	
	// табличный вид
	if($('.layout').length > 0){
		if($(window).width() <700){
			$('a.tables').removeClass('active');
			$('a.blocks').addClass('active');
			$('.layout').hide();
			$('.cat-sl').removeClass('table-cat');
			
		}
	}
	
	if($('.albums-det a img').length>0){
		if($(window).width() <580){
			$('.albums-det a img').each(function(){
				$(this).attr('src', $(this).attr('data-mobile'));
			});
		}
	}
	
	// ресайз
 	$( window ).resize(function() {
		var width = $(window).width();
		 if(width > 850){
			$('.bottom-head ul').css('display', 'block');
			$('.m-menu').removeClass('opened');
		 }
		 if(width < 850){
			$('.bottom-head ul').css('display', 'none');
			
		 }
		 
		if($('.layout').length > 0){
		  if(width < 700){
			if($('.layout').length > 0){
				$('a.tables').removeClass('active');
				$('a.blocks').addClass('active');
				$('.layout').hide();
				$('.cat-sl').removeClass('table-cat');
			}
		  }
		  
		  if(width > 700){
			if($('.layout').length > 0){
				$('.layout').show();
			}
		  }
		}

		if($('.albums-det a img').length>0){
			if($(window).width() < 580){
				$('.albums-det a img').each(function(){
					$(this).attr('src', $(this).attr('data-mobile'));
				});
			}
			if($(window).width() > 580){
				$('.albums-det a img').each(function(){
					$(this).attr('src', $(this).attr('data-desc'));
				});
			}
		}
		if($('.filt-wrap').length>0){
			if($(window).width() > 1005){
				$('.filt-wrap').css('display', 'inline-block');
				$('.filt-res').css('display', 'inline-block');
				$('.filt-res').removeClass('op');
			}
			if($(window).width() < 1005){
				$('.filt-wrap').hide();
				$('.filt-res').hide().addClass('op');
				$('.filt-open').removeClass('opend');
			}
		}
		
	}); 
	
	$('.m-menu').click(function(){
		if($(this).hasClass('opened')){
			$(this).removeClass('opened');
			$('.bottom-head ul').slideUp(150);
		}else{
			$(this).addClass('opened');
			$('.bottom-head ul').slideDown(150);
			$('.bottom-head ul>li').each(function(){
				if($(this).find('div ul').length > 0){
					$(this).addClass('opens');
					
				}else{
				}
			});
		}
	});
	
	// right-menu
	if($('.right-menu').length > 0){
		$('.right-menu ul li').each(function(){
			if($(this).find('ul').length > 0){
				$(this).addClass('hasul');
				$('<div class="arrow"></div>').insertBefore($(this).find('>a'));
			}
		});
	}

	// правое меню стрелка
	$('.right-menu>ul>li.hasul>.arrow').click(function(){
		var item = $(this).parents('li');
		var ul = item.find('ul');
		if(item.hasClass('opened')){
			item.removeClass('opened');
		}else{
			item.addClass('opened');
		}
		//return false;
	});
	//	дефолтные фенси	
		$.extend($.fancybox.defaults, {
			padding : 0,
			maxWidth : 5555555, //'90%'
			maxHeight : 555555,
			fitToView:false,
			padding: 0,
			fixed: false,
			autoResize:false,
			autoCenter: false,
			helpers : {		
				overlay : {	
					css : {
						'background' : 'rgba(66,80,99,0.9)'
					}				
				},
				title : {
				type : 'inside'
				}
			}
		});	

	//валидация для ие
	if($('body').hasClass('forie')) { 
	  $.validator.addClassRules({
			  namereq: {
				required: true,
				minlength: 2
			  },
			   phoneinput: {
				minlength: 18
			  }
		}); 
        $("form").each(function(){
        $(this).validate();
        });
        $.validator.messages.required = "";
        $.validator.messages.email = "";
        $.validator.messages.namereq = "";
        $.validator.messages.phoneinput = "";
        $.validator.messages.minlength = "";
	}
	
	// phonemask	
	if ($('.phoneinput').length > 0) {
		 $('.phoneinput').inputmask("mask", {"mask": "+7-(999)-999-99-99"}); 
	}
	
	
	/*$('.ph-fnc, .ot-fns').click(function(){
		 if($(window).width() > 600){ */
			$('.ph-fnc, .ot-fns').fancybox({
				maxWidth : '90%', 
				maxHeight : '90%',
				fitToView:true,
				openEffect  : 'elastic',
				closeEffect : 'elastic'
			 });
		/*}else{
			return false;
		} 
	});*/
	
	$('.qst-item .alb-item').click(function(){
		var item = $(this).closest('.qst-item') ;
		if(item.hasClass('opened')){
			item.removeClass('opened');
			$(this).find('.middle div span').dotdotdot();
		}else{
			item.addClass('opened');
			$(this).find(' .middle div span').trigger("destroy");
		}
	});
	
	$('.qst-item-otz .al-arrow, .qst-item-otz .otziv-middle').click(function(){
		var item = $(this).closest('.qst-item-otz') ;
		if(item.hasClass('opened')){
			item.removeClass('opened');
		}else{
			item.addClass('opened');
		}
	});

		
	$('.filt-but').click(function(){
		 var cur;
        var $myBlock = $(this).parent('.filt-row');
		var yourClick = true;
		
		 if ($myBlock.css('display') == 'block' || $myBlock.css('display') == 'inline-block') {
			$myBlock.addClass('show');        
            $(document).bind('click.myEvent', function(e) {
                if (!yourClick && $(e.target).closest('.filt-row').length == 0  ) {
                    $('.filt-row').removeClass('show');
                    $(document).unbind('click.myEvent');					
                }else if(!yourClick && $(e.target).closest('.filt-but').length == 1   ){
					 $('.filt-row').removeClass('show');
					 var item = $(e.target).closest('.filt-row');
					 if(item.hasClass('show')){
							 item.removeClass('show');
							 $(document).unbind('click.myEvent');	
						}else{
							  $(document).unbind('click.myEvent');	
							 $('.filt-row').removeClass('show');
						}
				}
                yourClick = false;
            });
        }	

       
	});

	

	//фильтр ползунки
	 if ($('.filt-price').length > 0) {
		 $('.filt-price').each(function(){
			var item = $(this);
			item.find('.ins-left').html(item.find('.min').attr('start-data'));
			item.find('.ins-right').html(item.find('.max').attr('stop-data'));
		 });
	};
	
	 if ($('.price-slider').length > 0) {
       $('.price-slider').each(function(){
				var steps;
				$(this).noUiSlider({
				range: {
					'min': parseInt($(this).closest('.filt-price').find('.min').attr('start-data')),
					'max': parseInt($(this).closest('.filt-price').find('.max').attr('stop-data'))
				},
				format: wNumb({
					thousand: '',
					decimals: 0
				
				}),
				step: 1
				, start: [$(this).closest('.filt-price').find('.min').val(), $(this).closest('.filt-price').find('.max').val() ]
				, connect: true
			}),
			steps = $(this).closest('.filt-price').find('.min').attr('step-data');
			$(this).Link('lower').to($(this).closest('.filt-price').find('.min')), null, wNumb({
				decimals: 0
			});		
			
			$(this).Link('upper').to($(this).closest('.filt-price').find('.max'));
			
			$(this).on({			
				set: function(){
					$(this).closest('.filt-price').find('input').removeClass('noselect');
				}				
			});
		});
	}
	
	$('a.filt-open').click(function(){
		var item = $(this).closest('.filters').find('.filt-wrap');
		var item2 = $(this).closest('.filters').find('.filt-res');
		if($(this).hasClass('opend')){
			$(this).removeClass('opend');
			item.slideUp(150);
			item2.slideUp(150);
		}else{
			$(this).addClass('opend');
			item.slideDown(150);
			item2.slideDown(150);
		}
	});

		
		// слайдер в карточке товара	
	if($('#bx-pager .bx-p').length > 0){	
		var realSlider = $('.tov-slider').bxSlider({
		  pager: false,
		  infiniteLoop:false,
		  controls:false,
		  hideControlOnEnd:true,
		  onSlideBefore:function($slideElement, oldIndex, newIndex){
			changeRealThumb(realThumbSlider,newIndex);
		  }
		});  
		
		var width2 = $(window).width();
		var mxslides = 6,
			slmargin = 6;
		if(width2 < 700){
			mxslides = 4
			slmargin = 17;
		}
		var realThumbSlider = $('#bx-pager .bx-p').bxSlider({
			slideWidth: 105,
			pager:false,
			minSlides:2,
			maxSlides: mxslides,
			pager:false,
			infiniteLoop:false,
			slideMargin: slmargin,
			controls:true,
			hideControlOnEnd:true,
			onSlideBefore:function($slideElement, oldIndex, newIndex){
		  }
		});
		
		
		
		function linkRealSliders(bigS,thumbS){
		  $("#bx-pager .bx-p a").click(function(event){
			event.preventDefault();
			var newIndex=$(this).attr("data-slide-index");
				bigS.goToSlide(newIndex);
		  });
		}
		linkRealSliders(realSlider,realThumbSlider);
		
		
			function changeRealThumb(slider,newIndex){
			var $thumbS=$("#bx-pager .bx-p");
			$thumbS.find('.active').removeClass("active");
			$thumbS.find('a[data-slide-index="'+newIndex+'"]').addClass("active");
			}

		
			$( window ).resize(function() {
				var width = $(window).width();
				if(width < 600){
					realThumbSlider.destroySlider();
				}else if(width < 700){
					realThumbSlider.destroySlider();
					realThumbSlider = $('#bx-pager .bx-p').bxSlider({
						slideWidth: 105,
						pager:false,
						minSlides:2,
						maxSlides: 4,
						pager:false,
						infiniteLoop:false,
						slideMargin: 18,
						controls:true,
						hideControlOnEnd:true,
						onSlideBefore:function($slideElement, oldIndex, newIndex){}
					  });
					
				}else if(width > 700){
					realThumbSlider.destroySlider();
					 realThumbSlider = $('#bx-pager .bx-p').bxSlider({
						slideWidth: 105,
						pager:false,
						minSlides:2,
						maxSlides: 6,
						pager:false,
						infiniteLoop:false,
						slideMargin: 6,
						controls:true,
						hideControlOnEnd:true,
						onSlideBefore:function($slideElement, oldIndex, newIndex){}
					  });
				}
			}); 
			
			$('.t-left').click(function(){
				realSlider.goToPrevSlide();
			});
			
			$('.t-right').click(function(){
				realSlider.goToNextSlide();
			});
	}	
	
	//переключение плашек карточка товара
	if($('.new-big-block').length > 0){
		$('.new-big-thumbs a').click(function(){
			if($(this).hasClass('active') || $(this).hasClass('disabled') ){
			}else{
				var item = $(this).attr('data-item');
				var use = $(this);
				$('.new-big-thumbs a').removeClass('active');
				$('.new-data').removeClass('active');
				$(this).addClass('active');
				$('.new-data').each(function(){
					if($(this).attr('id') == item){
						$(this).addClass('active');
					}
				});				
			}
		});
	} 
	
	if($('#data2').find('#map').length > 0){
	
	}else{
		var item = $('#data2').attr('id');			
		$('.new-big-thumbs a').each(function(){
			if($(this).attr('data-item') == item){
				$(this).addClass('disabled');
				$(this).click(function(){
					return false;
				});
			}
		});
	}	 
	
	$('.usl-item  img').each(function(){
		$(this).parents('.usl-item').addClass('yeah');
	});


    $('.cr').click(function(){
        $('.cr-wr').addClass('opened');
    });
    $('.close-cr').click(function(){
        $('.cr-wr').removeClass('opened');
    });
	
	
	// кредитный слайдер
	 if ($('.filt-slider').length > 0) {
		$('.filt-slider').each(function(){
			var starting = $(this).closest('.filt-row').find('.filt-sum').val();
			var steps;
			var crslider = $(this).noUiSlider({
				range: {
					'min': parseInt($(this).attr('start-data')),
					'max': parseInt($(this).attr('stop-data'))
				},
				format: wNumb({
					thousand: ' ',
					decimals: $(this).hasClass('dec') ? 1 : 0
				
				}),
				step: $(this).hasClass('dec') ? 0.5 : 1
				, start: starting
				
			});
			$(this).Link('lower').to($(this).closest('.filt-row').find('.filt-sum'));
			$(this).on({			
				slide: function(){
					$(this).closest('.filt-row').find('.filt-sum').removeClass('noselect');
					credit();
				},
				set: function(){
					$(this).closest('.filt-row').find('.filt-sum').removeClass('noselect');
					credit();
				}	
			});
			
			$(this).closest('.filt-row').find('.filt-sum').bind('textchange', function (event, previousText) {
				/* if ((key == 8 || key == 9 || key == 13 || key == 46 || key == 110 || key == 190 || (key >= 35 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105)))
                return false; */
				crslider.val($(this).val());
			});
		});
	}


	
	
	
	function credit(){
		var Format = wNumb({
			thousand: ' ',
			decimals: 0
		});

		var sum = 0,
			year = 0,
			yearplus = 0,
			fdays = 365,
			mydays = 0,
			mydaysmin = 0,
			ost = 0;
			var pig = $('.sum1').val().replace(/\s+/g, '');
			
		ost = pig - (pig/100*$('.sum2').val());
		year = parseFloat(($('.year').val()/100/12).toFixed(4));
		yearplus = 1 + year; 
		mydays = ($('.mydays').val()*12);
		mydaysmin = parseInt(-mydays);	
	
		var niz = 1 - (Math.pow((yearplus), mydaysmin)).toFixed(4);
		sum = parseInt(ost*(year/niz).toFixed(4));
		
		if(mydays == 0){
			$('.f-sum').text(Format.to(parseInt(ost)));
			$('.f-month').text(0);
		}else if(year == 0){
			sum = parseInt(ost/mydays);
			$('.f-sum').text(Format.to(parseInt(ost)));
			$('.f-month').text(Format.to(sum));
		}else{
			$('.f-sum').text(Format.to(parseInt(ost)));
			$('.f-month').text(Format.to(sum));
		}
	}

    if($('.sum1').length > 0){
        credit();
    }
	
	// загрузка файла

    $('.file_upload').each(function(i){

        var wrapper = $(this),
            inp = wrapper.find( "input" ),
            btn = wrapper.closest( ".row" ).find('.file-but'),
            lbl = wrapper.find( "div" );

        btn.focus(function(){
            inp.focus()
        });

        inp.focus(function(){
            wrapper.addClass( "focus" );
        }).blur(function(){
            wrapper.removeClass( "focus" );
        });

        var file_api = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false;

        inp.change(function(){
            var file_name;
            if( file_api && inp[ 0 ].files[ 0 ] )
                file_name = inp[ 0 ].files[ 0 ].name;
            else
                file_name = inp.val().replace( "C:\\fakepath\\", '' );

            if( ! file_name.length )
                return;

            if( lbl.is( ":visible" ) ){
                lbl.text( file_name );
            }else{
            }

        }).change();

    });


	
});
$( window ).load(function() {
  $('.alb-item.vop .middle div span').dotdotdot();
});

function showFavorite(){
    var scroll = $(this).scrollTop();
    if(scroll < 40){
        return false;
    }

    $('.fix-dop').show(0);
    $('.fix-dop').addClass('topp');
    $(window).scroll(function(){

        setTimeout(function(){
            $('.fix-dop').fadeOut(100);
            $('.fix-dop').removeClass('topp');
        },100);

    });
}