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
                    <?if($picture = $arItem['PROPERTIES']['LINKS_TO_PICS']['VALUE'][0]){?>
                    <img width='167' height='163' src="<?=$picture?>">
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
                <?if($arItem['IBLOCK_SECTION_ID']==24){?> <!-- Индивидуальная -->
                  <div class="data">
                    <?if($arItem['PROPERTIES']['SQUARE']['VALUE'] && $arItem['PROPERTIES']['SQUARE']['VALUE']<>"0.00"){?>
                      <span>S <small>д.</small> = <?=$arItem['PROPERTIES']['SQUARE']['VALUE']?> кв.м</span>
                    <?} else {?>
                      <span></span>
                    <?}?>
                    
                  </div>
                  <div class="data">
                    <?if($arItem['PROPERTIES']['FLOORS']['VALUE']){?>
                      <span>Этажей = <?=$arItem['PROPERTIES']['FLOORS']['VALUE']?></span>
                    <?} else {?>
                      <span></span>
                    <?}?>
                  </div>
                  <div class="data">
                    <?if($arItem['PROPERTIES']['HECTARE']['VALUE'] && $arItem['PROPERTIES']['HECTARE']['VALUE']<>"0.00"){?>
                      <span>S <small>у.</small> = <?=$arItem['PROPERTIES']['HECTARE']['VALUE']?> сот.</span>
                    <?} else {?>
                      <span></span>
                    <?}?>
                  </div>
                <?}?>
                <?if($arItem['IBLOCK_SECTION_ID']==20 || $arItem['IBLOCK_SECTION_ID']==22){?> <!-- Квартиры, новостройки -->
                  <div class="data">
                    <span>S <small>общ.</small> = <?=$arItem['PROPERTIES']['SQUARE']['VALUE']?> кв.м</span>
                  </div>
                  <div class="data">
                    <span>Этаж = <?=$arItem['PROPERTIES']['FLOOR']['VALUE']?></span>
                  </div>
                  <div class="data">
                    <span>Этажей = <?=$arItem['PROPERTIES']['FLOORS']['VALUE']?></span>
                  </div>
                <?}?>
                <?if($arItem['IBLOCK_SECTION_ID']==21){?><!-- ЖК -->
                  <div class="data">
                    <span>S <small>общ.</small> = <?=$arItem['PROPERTIES']['SQUARE']['VALUE']?> кв.м</span>
                  </div>
                  <div class="data">
                    <span>Варианты: <?=$arItem['PROPERTIES']['ROOMS']['VALUE']?></span>
                  </div>
                <?}?>
                <?if($arItem['IBLOCK_SECTION_ID']==23){?><!-- Коммерческая -->
                  <div class="data">
                    <span>S <small>общ.</small> = <?=$arItem['PROPERTIES']['SQUARE']['VALUE']?> кв.м</span>
                  </div>
                  <div class="data">
                    <?if($arItem['PROPERTIES']['HECTARE']['VALUE'] && $arItem['PROPERTIES']['HECTARE']['VALUE']<>"0.00"){?>
                      <span>S <small>у.</small> = <?=$arItem['PROPERTIES']['HECTARE']['VALUE']?> сот.</span>
                    <?} else {?>
                      <span></span>
                    <?}?>
                  </div>
                  <div class="data">
                    <?if($arItem['PROPERTIES']['FLOOR']['VALUE'] && $arItem['PROPERTIES']['FLOOR']['VALUE']<>"0.00"){?>
                      <span>Этаж = <?=$arItem['PROPERTIES']['FLOOR']['VALUE']?></span>
                    <?} else {?>
                      <span></span>
                    <?}?>
                  </div>
                  <div class="data">
                    <?if($arItem['PROPERTIES']['FLOORS']['VALUE'] && $arItem['PROPERTIES']['FLOORS']['VALUE']<>"0.00"){?>
                      <span>Этажей = <?=$arItem['PROPERTIES']['FLOORS']['VALUE']?></span>
                    <?} else {?>
                      <span></span>
                    <?}?>
                  </div>
              
                <?}?>
                <div class="final">
                    <?if($arParams['IS_FAVORITE'] == "Y"){?>
                        <a href="#" class="del" data-id="<?=$arItem['ID']?>"><span></span></a>
                    <?}else{?>
                        <a href="#" class="otl otl-list" data-id="<?=$arItem['ID']?>"><span></span></a>
                    <?}?>
                    <?if($arItem['PROPERTIES']['PRICE']['VALUE']){?>
                        <div class="price">
                          <?if($arItem['IBLOCK_SECTION_ID']==21){?>от<?}?>
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