<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>

<?if (empty($arResult)) return;?>

<?foreach($arResult as $arItem){?>
    <a <?=$arItem["SELECTED"]?'class="active"':''?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
<?}?>
