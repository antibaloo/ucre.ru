<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>

<?//echo '<pre>';print_r($arResult);echo '</pre>';?>

<div class="del-date"><?=$arResult['DISPLAY_ACTIVE_FROM']?></div>

<?if(strlen($arResult["DETAIL_TEXT"])>0){?>
    <?=$arResult["DETAIL_TEXT"];?>
<?}else{?>
    <?=$arResult["PREVIEW_TEXT"];?>
<?}?>

<?if($picture = $arResult['DETAIL_PICTURE']){ ?>

    <div>
        <?$file = CFile::ResizeImageGet($picture, array('width'=>662, 'height'=>662), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
        <div>
            <img src="<?=$file['src']?>">
            <div class="img-desc">
                <?=$arResult['NAME']?>
            </div>
        </div>
    </div>

<?}?>
<script type="text/javascript">(function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();</script>
<div class="pluso" data-background="transparent" data-options="small,round,line,horizontal,counter,theme=08" data-services="facebook,vkontakte,odnoklassniki,twitter,google,moimir"></div>
<div class="share">
    <div class="all-list">
        <a href="<?=$arResult['LIST_PAGE_URL']?>"><?=GetMessage('NDN_ALL_NEWS')?></a>
    </div>

</div>




