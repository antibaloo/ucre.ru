<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if( !CModule::IncludeModule("iblock") ) return;

$arIBlockType_form = CIBlockParameters::GetIBlockTypes();

$arIBlock_form = array();
$rsIBlock = CIBlock::GetList( array("sort" => "asc"), array("TYPE" => $arCurrentValues["F_IBLOCK_TYPE"], "ACTIVE" => "Y") );
while( $arr = $rsIBlock->Fetch() ){
    $arIBlock_form[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arTemplateParameters = array(
    "F_IBLOCK_TYPE" => array(
        "SORT" => 600,
        "NAME" => GetMessage("F_BN_P_IBLOCK_TYPE"),
        "TYPE" => "LIST",
        "VALUES" => $arIBlockType_form,
        "REFRESH" => "Y",
    ),
    "F_IBLOCK_ID" => array(
        "SORT" => 610,
        "NAME" => GetMessage("F_BN_P_IBLOCK"),
        "TYPE" => "LIST",
        "VALUES" => $arIBlock_form,
        "REFRESH" => "Y",
        "ADDITIONAL_VALUES" => "Y",
    ),
    "F_TITLE_FORM" => array(
        "SORT" => 620,
        "NAME" => GetMessage('F_TITLE_FORM'),
        "TYPE" => "STRING",
        "DEFAULT" => '',
    ),
    "F_SUCCESS_MESSAGE" => array(
        "SORT" => 630,
        "NAME" => GetMessage("F_SUCCESS_MESSAGE"),
        "TYPE" => "STRING",
        "DEFAULT" => GetMessage("F_DEFAULT_SUCCESS_MESSAGE"),
    ),
    "F_SEND_BUTTON_NAME" => array(
        "SORT" => 640,
        "NAME" => GetMessage("F_SEND_BUTTON_NAME"),
        "TYPE" => "STRING",
        "DEFAULT" => GetMessage("F_DEFAULT_SEND_BUTTON_NAME"),
    ),
    "F_CLOSE_BUTTON_NAME" => array(
        "SORT" => 650,
        "NAME" => GetMessage("F_CLOSE_BUTTON_NAME"),
        "TYPE" => "STRING",
        "DEFAULT" => GetMessage("F_DEFAULT_CLOSE_BUTTON_NAME"),
    )
);
?>