<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?//echo '<pre>';print_r($arResult);echo '</pre>';?>

<?if(count($arResult["ITEMS"]) === 0) return?>

<?
if($slider_width = $arParams['SLIDER_WIDTH']){
    if($slider_width == 'wide'){
        $slider_width_class = '';
    }
    elseif($slider_width == 'medium'){
        $slider_width_class = 'sl-medium';
    }
    elseif($slider_width == 'mini'){
        $slider_width_class = 'sl-mini';
    }
}
?>

<div class="main-slider-wrap">
    <div class="main-slider <?=$slider_width_class?>">
        <ul class="slider">
            <?foreach($arResult["ITEMS"] as $arItem){?>
                <?
                $this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem["ID"], $arItem["DELETE_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
                ?>
            <li id="<?=$this->GetEditAreaId($arItem["ID"])?>">
                <?if($picture = $arItem['PREVIEW_PICTURE']){?>
                    <?$file = CFile::ResizeImageGet($picture, array('width'=>1933, 'height'=>421), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                    <img src="<?=$file['src']?>">
                <?}?>

                <?if($arItem['PROPERTIES']['TYPE']['VALUE_XML_ID'] != 1){?>
                <div class="wrapper textcolor-<?=$arItem['PROPERTIES']['TEXTCOLOR']['VALUE_XML_ID']?> textpos-<?=$arItem['PROPERTIES']['TYPE']['VALUE_XML_ID']?>">
                    <div class="title"><?=$arItem['NAME']?></div>
                    <div class="desc">
                        <?=$arItem['PREVIEW_TEXT']?>
                    </div>
                    <div class="final">
                        <?if($arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']){?>
                        <a <?=$arItem['PROPERTIES']['BUTTON1LINK']['VALUE']?'href="'.$arItem['PROPERTIES']['BUTTON1LINK']['VALUE'].'"':''?> class="button"><?=$arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']?></a>
                        <?}?>
                        <?if($arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']){?>
                            <a <?=$arItem['PROPERTIES']['BUTTON2LINK']['VALUE']?'href="'.$arItem['PROPERTIES']['BUTTON2LINK']['VALUE'].'"':''?> class="button destr"><?=$arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']?></a>
                        <?}?>
                    </div>
                </div>
                <?}?>
            </li>
            <?}?>
        </ul>
    </div>
</div>


