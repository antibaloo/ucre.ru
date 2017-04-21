<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arParams['IS_FAVORITE'] == "Y")
{
    $this->setFrameMode(false);
}
else
{
    $this->setFrameMode(true);
}


if($arParams['ITEMS_ONLY'] == 'Y' && count($arResult['ITEMS']) == 0){
    return;
}
?>
<?//echo '<pre>';print_r($arResult);echo '</pre>';?>

<?if($arParams['ITEMS_ONLY'] != 'Y'){?>
<div class="sl cat-sl ">
<?}?>

    <?foreach($arResult['ITEMS'] as $arItem){?>
        <?
        $this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem["ID"], $arItem["DELETE_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
        ?>
        <?if($arParams['ITEMS_ONLY'] != 'Y'){?>
        <div class="item-tb col-lg-3  col-md-4 col-sm-6">
        <?}?>
            <div  class="item" id="<?=$this->GetEditAreaId($arItem["ID"])?>">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="img">
                    <?if($picture = $arItem['DETAIL_PICTURE']){?>
                    <?$file = CFile::ResizeImageGet($picture, array('width'=>373, 'height'=>259), BX_RESIZE_IMAGE_EXACT, true); ?>
                    <img src="<?=$file['src']?>">
                    <?}else{?>
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/stub_realty.jpg">
                    <?}?>
                </a>
                <div class="m-des">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="title"><span><?=$arItem['NAME']?></span></a>
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="adr"><?=$arItem['PROPERTIES']['ADDRESS']['VALUE']?></a>
                    <?if($arItem['PROPERTIES']['AREA']['VALUE']){?>
                    <div class="area"><?=$arItem['PROPERTIES']['AREA']['VALUE']?> <?=GetMessage('CSR_AREA')?></div>
                    <?}?>
                </div>
                <div class="data">
                    <?if($arItem['PROPERTIES']['SQUARE']['VALUE']){?>
                    <span><?=$arItem['PROPERTIES']['SQUARE']['VALUE']?> <?=GetMessage('CSR_SQUARE')?> </span>
                    <?}?>
                    <?if($arItem['PROPERTIES']['FLOOR']['VALUE']){?>
                    <span><?=$arItem['PROPERTIES']['FLOOR']['VALUE']?><?=$arItem['PROPERTIES']['FLOORS']['VALUE']?'/'.$arItem['PROPERTIES']['FLOORS']['VALUE']:''?> <?=GetMessage('CSR_FLOOR')?></span>
                    <?}?>
                    &nbsp;
                </div>
                <div class="final">
                    <?if($arParams['IS_FAVORITE'] == "Y"){?>
                        <a href="#" class="del" data-id="<?=$arItem['ID']?>"><span></span></a>
                    <?}else{?>
                        <a href="#" class="otl otl-list" data-id="<?=$arItem['ID']?>"><span></span></a>
                    <?}?>
                    <?if($arItem['PROPERTIES']['PRICE']['VALUE']){?>
                        <div class="price">
                            <?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'],0,'.', ' ')?>
                            <?=GetMessage('CURRENCY')?>
                        </div>
                    <?}?>
                </div>
            </div>
        <?if($arParams['ITEMS_ONLY'] != 'Y'){?>
        </div>
        <?}?>
    <?}?>

<?if($arParams['ITEMS_ONLY'] != 'Y'){?>
    <?=$arResult['NAV_STRING']?>

</div>
<?}?>


<?if($arParams['ITEMS_ONLY'] != 'Y'){?>
<script>
    if($('.layout').length > 0){
        var layout = $('.layout a.active').data('layout');
        if(layout == 'tables'){
            $('.cat-sl').addClass('table-cat');
        }else{
            $('.cat-sl').removeClass('table-cat');
        }
    }
</script>
<?}?>

<script>
    var favorite = BX.localStorage.get('favorite');
    if(favorite){
        favorite.forEach(function(id) {
            $('.otl-list[data-id='+id+']').addClass('gold');
        });
    }
</script>