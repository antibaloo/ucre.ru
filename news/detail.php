<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новость");
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "news_ucre",
    Array(
        "IBLOCK_TYPE" => "ittian_realty_content",
        "IBLOCK_ID" => "8",
        "ELEMENT_ID" => "",
        "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
        "CHECK_DATES" => "Y",
        "FIELD_CODE" => array("SECTION_PAGE_URL"),
        "PROPERTY_CODE" => array(""),
        "IBLOCK_URL" => "",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ADD_ELEMENT_CHAIN" => "Y",
        "ACTIVE_DATE_FORMAT" => "j F Y",
        "USE_PERMISSIONS" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "USE_SHARE" => "N",
        "PAGER_TEMPLATE" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "",
        "PAGER_SHOW_ALL" => "Y"
    )
);?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>