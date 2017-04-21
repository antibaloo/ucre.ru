<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$empty = true;
foreach($arResult["ITEMS"] as $key=>$arItem)
{
    $ar_checked = array();

    foreach($arItem['VALUES'] as $value)
    {
        if($value['CHECKED'])
        {
            $ar_checked[] = $value;
        }

        if(isset($arItem["PRICE"]))
        {

        }
        else
        {
            if($empty && count($arItem['VALUES']))
            {
                $empty = false;
            }
        }
    }
    if(count($ar_checked))
    {
        $arResult["ITEMS"][$key]['CHECKED_ITEMS'] = $ar_checked;
    }
}

if($empty)
{
    $arResult['EMPTY'] = 1;
}