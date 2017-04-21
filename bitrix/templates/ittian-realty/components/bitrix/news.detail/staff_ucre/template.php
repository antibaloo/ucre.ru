<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?ob_start();?>

<div class="sotr-card">
    <div class="left">
        <?if($arResult['PROPERTIES']['PHOTO_LINK']['VALUE']){?>
            <?$file = CFile::ResizeImageGet($picture, array('width'=>257, 'height'=>288), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
            <img width="257" height="auto" src="<?=$arResult['PROPERTIES']['PHOTO_LINK']['VALUE']?>">
        <?}else{?>
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/stub-staff.jpg">
        <?}?>
    </div>
    <div class="right">
        <div class="title"><?=$arResult['PROPERTIES']['POST']['VALUE']?></div>
        <div class="sot-phone"><?=nl2br($arResult['PROPERTIES']['PHONE']['VALUE'])?></div>
        <div class="sot-mail"><a href="mailto:<?=trim($arResult['PROPERTIES']['EMAIL']['VALUE'])?>"><?=$arResult['PROPERTIES']['EMAIL']['VALUE']?></a></div>
        <?if ($arResult['IBLOCK_SECTION_ID']==18 || $arResult['IBLOCK_SECTION_ID']==42){?>
          <div class="sot-phone"><span style="color:black">Рейтинг сотрудника: <?=nl2br($arResult['SORT'])?></span></div>
        <?}?>
        <div class="desc">
            <?=$arResult["DETAIL_TEXT"];?>
        </div>
        <div class="final">
            <!--#forms-->
        </div>
    </div>
</div>

<?if($arResult['PROPERTIES']['SERT']['VALUE']){?>
<h2><?=GetMessage('ND_STAFF_SERT')?></h2>
<div class="sert-wrap">

    <div class="left">
        <div class="sert-wr">
            <div class="meter">
                <?foreach($arResult['PROPERTIES']['SERT']['VALUE'] as $picture){?>
                    <?$img = CFile::ResizeImageGet($picture, array('width'=>225, 'height'=>225), BX_RESIZE_IMAGE_EXACT, true); ?>
                <a href="<?=CFile::GetPath($picture)?>" class="ph-fnc s-item" rel="sert" title="">
                    <img src="<?=$img['src']?>">
                </a>
                <?}?>
                <a class="more"><?=GetMessage('ND_STAFF_SHOWALL')?></a>
            </div>
        </div>
    </div>
</div>
<?}?>


<?
ob_start();
$GLOBALS['arrFilter_staff'] = array("PROPERTY_STAFF"=>$arResult['ID']);
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "ucre",
    Array(
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => $arParams['REALTY_IBLOCK_TYPE'],
        "IBLOCK_ID" => $arParams['REALTY_IBLOCK_ID'],
        "SECTION_ID" => "",
        "SECTION_CODE" => '',
        "SECTION_USER_FIELDS" => array(""),
        "ELEMENT_SORT_FIELD" => 'ID',
        "ELEMENT_SORT_ORDER" => 'desc',
        "FILTER_NAME" => "arrFilter_staff",
        "INCLUDE_SUBSECTIONS" => "Y",
        "SHOW_ALL_WO_SECTION" => "Y",
        "SECTION_URL" => "",
        "DETAIL_URL" => "",
        "BASKET_URL" => "/personal/basket.php",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "SECTION_ID_VARIABLE" => "",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "ADD_SECTIONS_CHAIN" => "N",
        "DISPLAY_COMPARE" => "N",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "PAGE_ELEMENT_COUNT" => '20',
        "LINE_ELEMENT_COUNT" => "4",
        "PROPERTY_CODE" => array("STAFF"),
        "OFFERS_LIMIT" => "",
        "PRICE_CODE" => array(""),
        "USE_PRICE_COUNT" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_PROPERTIES" => array(),
        "USE_PRODUCT_QUANTITY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "orange",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "CONVERT_CURRENCY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "ELEMENT_SORT_FIELD2" => "",
        "ELEMENT_SORT_ORDER2" => "",
        "HIDE_NOT_AVAILABLE" => "N",
        "OFFERS_FIELD_CODE" => array(""),
        "OFFERS_PROPERTY_CODE" => array(""),
        "OFFERS_SORT_FIELD" => "SORT",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_FIELD2" => "",
        "OFFERS_SORT_ORDER2" => "",
        "SET_META_KEYWORDS" => "Y",
        "SET_META_DESCRIPTION" => "Y",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "OFFERS_CART_PROPERTIES" => array(),
        "ITEMS_ONLY"=>"N"
    ),
    $component,
    array("HIDE_ICONS" => "Y")
);
$realty = ob_get_contents();
ob_get_clean();
?>

<?if($realty != ''){?>
<h2><?=GetMessage('ND_STAFF_OBJECTS')?></h2>


    <div class="sl" id="spec-main">
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "ucre",
    Array(
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => $arParams['REALTY_IBLOCK_TYPE'],
        "IBLOCK_ID" => $arParams['REALTY_IBLOCK_ID'],
        "SECTION_ID" => "",
        "SECTION_CODE" => '',
        "SECTION_USER_FIELDS" => array(""),
        "ELEMENT_SORT_FIELD" => 'ID',
        "ELEMENT_SORT_ORDER" => 'desc',
        "FILTER_NAME" => "arrFilter_staff",
        "INCLUDE_SUBSECTIONS" => "Y",
        "SHOW_ALL_WO_SECTION" => "Y",
        "SECTION_URL" => "",
        "DETAIL_URL" => "",
        "BASKET_URL" => "/personal/basket.php",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "SECTION_ID_VARIABLE" => "",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "ADD_SECTIONS_CHAIN" => "N",
        "DISPLAY_COMPARE" => "N",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "PAGE_ELEMENT_COUNT" => '20',
        "LINE_ELEMENT_COUNT" => "4",
        "PROPERTY_CODE" => array("STAFF"),
        "OFFERS_LIMIT" => "",
        "PRICE_CODE" => array(""),
        "USE_PRICE_COUNT" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_PROPERTIES" => array(),
        "USE_PRODUCT_QUANTITY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "orange",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "CONVERT_CURRENCY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "ELEMENT_SORT_FIELD2" => "",
        "ELEMENT_SORT_ORDER2" => "",
        "HIDE_NOT_AVAILABLE" => "N",
        "OFFERS_FIELD_CODE" => array(""),
        "OFFERS_PROPERTY_CODE" => array(""),
        "OFFERS_SORT_FIELD" => "SORT",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_FIELD2" => "",
        "OFFERS_SORT_ORDER2" => "",
        "SET_META_KEYWORDS" => "Y",
        "SET_META_DESCRIPTION" => "Y",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "OFFERS_CART_PROPERTIES" => array(),
        "ITEMS_ONLY"=>"N"
    ),
    $component,
    array("HIDE_ICONS" => "Y")
);
      ?>

    </div>

<?}?>


<?$this->__component->arResult["CACHED_TPL"] = ob_get_contents();
ob_get_clean();?>