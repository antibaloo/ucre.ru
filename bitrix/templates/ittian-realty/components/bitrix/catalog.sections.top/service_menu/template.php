<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?//echo '<pre>';print_r($arParams);echo '</pre>';?>

<div class="right-menu">
    <ul>

        <?foreach($arResult['SECTIONS'] as $arSection){?>
            <li <?=$arParams["SELECT_SECTION_CODE"] && $arSection['CODE']==$arParams["SELECT_SECTION_CODE"]?'class="opened"':''?>>
                <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><span><?=$arSection["NAME"]?></span></a>
                <?if($arSection['ITEMS'] && count($arSection['ITEMS'])){?>
                    <ul>
                        <?foreach($arSection['ITEMS'] as $arItem){?>
                            <li>
                                <a <?=$arParams["SELECT_ELEMENT_ID"] && $arItem['ID']==$arParams["SELECT_ELEMENT_ID"]?'class="active"':''?> href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                            </li>
                        <?}?>
                    </ul>
                <?}?>
            </li>
        <?}?>

    </ul>
</div>