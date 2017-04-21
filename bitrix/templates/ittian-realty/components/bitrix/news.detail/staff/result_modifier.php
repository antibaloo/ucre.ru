<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->__component->arResult["STUFF_EMAIL"] = trim($arResult['PROPERTIES']['EMAIL']['VALUE']);

$this->__component->SetResultCacheKeys(array("CACHED_TPL","STUFF_EMAIL"));

