<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ITEMS"] as $arItem){
    if($SID = $arItem["IBLOCK_SECTION_ID"]){
        $arSectionsIDs[] = $SID;
    }
}

/*if($arSectionsIDs){
    $arResult["SECTIONS"] = CCache::CIBLockSection_GetList(array("SORT" => "ASC", "NAME" => "ASC", "CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "GROUP" => array("ID"), "MULTI" => "N")), array("ID" => $arSectionsIDs));
}*/

$rs = CIBLockSection::GetList(array("SORT" => "ASC", "NAME" => "ASC"), array("ID" => $arSectionsIDs));
while ($ar = $rs->GetNext())
{
    $arResult["SECTIONS"][$ar['ID']]['SECTION'] = $ar;
}

// group elements by sections
foreach($arResult["ITEMS"] as $arItem){
    $SID = ($arItem["IBLOCK_SECTION_ID"] ? $arItem["IBLOCK_SECTION_ID"] : 0);
    $arResult["SECTIONS"][$SID]["ITEMS"][$arItem["ID"]] = $arItem;
}

// unset empty sections
foreach($arResult["SECTIONS"] as $i => $arSection){
    if(!$arSection["ITEMS"]){
        unset($arResult["SECTIONS"][$i]);
    }
}

if(!$arResult['SECTIONS'])
{
    $arResult['SECTIONS'][]['ITEMS'] = $arResult['ITEMS'];
}
