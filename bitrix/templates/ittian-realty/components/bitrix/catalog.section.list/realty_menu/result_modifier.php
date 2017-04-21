<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult['SECTIONS'] as $arItem)
{
    if($arParams['SECTION_CODE2']==$arItem["CODE"])
    {
        $arResult['CATALOG_SECTION_ID'] = $arItem['ID'];
        $this->__component->SetResultCacheKeys(array("CATALOG_SECTION_ID"));
        break;
    }
}