<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>

<?if(strlen($arResult["DETAIL_TEXT"])>0){?>
    <?echo $arResult["DETAIL_TEXT"];?>
<?}else{?>
    <p><?echo $arResult["PREVIEW_TEXT"];?></p>
<?}?>
