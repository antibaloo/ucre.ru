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

<div class="share">
    <div class="all-list">
        <a href="<?=$arResult['LIST_PAGE_URL']?>"><?=GetMessage('NDN_ALL_NEWS')?></a>
    </div>

</div>




