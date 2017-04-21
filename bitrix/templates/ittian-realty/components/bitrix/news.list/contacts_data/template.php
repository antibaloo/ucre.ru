<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?//echo '<pre>';print_r($arResult['ITEMS']);echo '</pre>';?>

<?if(!count($arResult['ITEMS'])) return;?>

<?foreach($arResult['ITEMS'] as $arItem){?>
<?
$this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem["ID"], $arItem["DELETE_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
?>

<div class="top-b col-lg-4 <?=$arItem['PROPERTIES']['TYPE']['VALUE_XML_ID']?>" id="<?=$this->GetEditAreaId($arItem["ID"])?>">
    <div class="b-wrap">
        <div class="top"><?=$arItem['NAME']?></div>
        <div class="bot"><?=nl2br($arItem['PROPERTIES']['TEXT']['VALUE'])?></div>
    </div>
</div>

<?}?>
