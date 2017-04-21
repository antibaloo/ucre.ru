<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$tpl = $arResult["CACHED_TPL"];

ob_start();
$APPLICATION->IncludeComponent(
    "tiangroup:forms",
    "",
    Array(
        "IBLOCK_TYPE" => $arParams['F_IBLOCK_TYPE'],
        "IBLOCK_ID" => $arParams['F_IBLOCK_ID'],
        "SUCCESS_MESSAGE" => $arParams['F_SUCCESS_MESSAGE'],
        "SEND_BUTTON_NAME" => $arParams['F_SEND_BUTTON_NAME'],
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CLOSE_BUTTON_NAME" => $arParams['F_CLOSE_BUTTON_NAME'],
        "TITLE_FORM" => $arParams['F_TITLE_FORM'],
        "EMAIL_TO"=>$arResult["STUFF_EMAIL"],
    ),
    $component,
    array("HIDE_ICONS" => "Y")
);
$forms = ob_get_clean();
$tpl = str_replace('<!--#forms-->',$forms, $tpl);

echo $tpl;
