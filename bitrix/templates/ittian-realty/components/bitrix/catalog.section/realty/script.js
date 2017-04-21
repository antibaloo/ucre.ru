$(function(){
    $('.otl-list').click(function(){

        var $this = $(this);
        var id = $this.data('id');

        var favorite = BX.localStorage.get('favorite');

        if($this.hasClass('gold')){
            $this.removeClass('gold');

            if(favorite){
                var index = favorite.indexOf(id);
                if(index > -1){
                    favorite.splice(index, 1);
                }
            }
        }else{
            $this.addClass('gold');

            if(favorite){
                if(favorite.indexOf(id) == -1){
                    favorite.push(id);
                }
            }else{
                favorite = [id];
            }

            showFavorite();
        }

        if(favorite && favorite.length == 0){
            favorite = null;
            BX.localStorage.set('favorite',"",1);
        }

        if(favorite){
            BX.localStorage.set('favorite',favorite,30758400);
            $('.as-desc span d').text(favorite.length);
        }else{
            $('.as-desc span d').text(0);
        }

        $.ajax({
            type: "post",
            dataType: "json",
            url: SiteOptions.SITE_DIR+"ajax/favorite.php",
            data: {
                favorite: favorite
            },
            success: function(data){
            }
        });

        return false;
    });

    $('.final .del').click(function(){

        $(this).closest('.item-tb').fadeOut();

        var $this = $(this);
        var id = $this.data('id');

        var favorite = BX.localStorage.get('favorite');

        if(favorite){
            var index = favorite.indexOf(id);
            if(index > -1){
                favorite.splice(index, 1);
            }

            if(favorite.length){
                BX.localStorage.set('favorite',favorite,30758400);
                $('.as-desc span d').text(favorite.length);

            }else{
                BX.localStorage.set('favorite','',1);
                favorite = null;
                $('.as-desc span d').text(0);
            }
        }

        $.ajax({
            type: "post",
            dataType: "json",
            url: SiteOptions.SITE_DIR+"ajax/favorite.php",
            data: {
                favorite: favorite
            },
            success: function(data){
                if(data.result == 'empty'){
                    location.reload();
                }
            }
        });

        return false;
    });
});
