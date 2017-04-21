$(function(){
    $('.otl-elem').click(function(){

        var $this = $(this);
        var id = $this.data('id');

        var favorite = BX.localStorage.get('favorite');

        if($this.hasClass('gold')){
            $this.removeClass('gold');
            $this.find('t').text($this.data('to_gold'));

            if(favorite){
                var index = favorite.indexOf(id);
                if(index > -1){
                    favorite.splice(index, 1);
                }
            }
        }else{
            $this.addClass('gold');
            $this.find('t').text($this.data('gold'));

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



});