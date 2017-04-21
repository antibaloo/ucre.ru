<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arTemplateParameters["FORM_POSITION"] = array(
    "SORT" => 250,
    "NAME" => GetMessage("FORM_POSITION"),
    "TYPE" => "LIST",
    "VALUES" => array(
        "button" => GetMessage("FORM_POSITION_BUTTON"),
        "form" => GetMessage("FORM_POSITION_FORM"),
    ),
    "DEFAULT" => "button",
);


?>