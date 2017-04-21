<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?//echo '<pre>';print_r($arResult);echo '</pre>';?>

<ul>
    <?foreach($arResult['SECTIONS'] as $arItem){?>
        <li><a <?=$arParams['SECTION_CODE2']==$arItem["CODE"]?'class="active"':''?> href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a></li>
    <?}?>
</ul>
