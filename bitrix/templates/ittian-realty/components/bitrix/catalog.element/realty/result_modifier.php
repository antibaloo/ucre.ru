<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($staff_id = $arResult['PROPERTIES']['STAFF']['VALUE'])
{
    $res = CIBlockElement::GetList(array(),array('ID' => $staff_id),false,false,
        array("ID","IBLOCK_ID","NAME","DETAIL_PICTURE","DETAIL_PAGE_URL","PROPERTY_PHONE","PROPERTY_EMAIL"));
    if($ar = $res->GetNext())
    {
        $arResult['STAFF'] = $ar;

        $this->__component->arResult["STUFF_EMAIL"] = $arResult['STAFF']['PROPERTY_EMAIL_VALUE'];
    }
}


$this->__component->SetResultCacheKeys(array("CACHED_TPL","DETAIL_PAGE_URL","STUFF_EMAIL"));