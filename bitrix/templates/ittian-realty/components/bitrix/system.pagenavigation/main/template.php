<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);


if($arResult["NavPageCount"] <= 1){
    return;
}

//echo "<pre>"; print_r($arResult);echo "</pre>";

if($_REQUEST['set_filter'] == 'Y' || $_REQUEST['q'])
{
    $strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
    $strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
}

?>

<div class="pagination">
    <ul class="pager">
        <?for($i = $arResult['nStartPage']; $i <= $arResult['nEndPage']; $i++){?>
            <li><a <?=($i == $arResult['NavPageNomer'])?'class="active"':''?>  href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$i?>"><?=$i?></a></li>
        <?}?>
    </ul>
</div>


