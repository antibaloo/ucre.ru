<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?//echo '<pre>';print_r($arResult);echo '</pre>';?>

<?if (empty($arResult)) return;?>

<div class="right-menu">
    <ul>

    <?foreach($arResult as $arItem){?>
        <li <?=$arItem["SELECTED"]?'class="opened"':''?>>
            <a href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a>
            <?if($arItem['CHILD']){?>
            <ul>
                <?foreach($arItem['CHILD'] as $arItem2){?>
                    <li>
                        <a <?=$arItem2["SELECTED"]?'class="active"':''?> href="<?=$arItem2["LINK"]?>"><?=$arItem2["TEXT"]?></a>
                    </li>
                <?}?>
            </ul>
            <?}?>
        </li>
    <?}?>

    </ul>
</div>
