<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>

<?if (empty($arResult)) return;?>

<?foreach($arResult as $arItem){?>
    <li>
        <a <?=$arItem["SELECTED"]?'class="active"':''?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
        <?if($arItem['CHILD']){?>
        <ul>
            <?foreach($arItem['CHILD'] as $arItem2){?>
                <li>
                    <a <?=$arItem2["SELECTED"]?'class="active"':''?> href="<?=$arItem2["LINK"]?>"><?=$arItem2["TEXT"]?></a>
                    <?if($arItem2['CHILD']){?>
                    <ul>
                        <?foreach($arItem2['CHILD'] as $arItem3){?>
                            <li>
                                <a <?=$arItem3["SELECTED"]?'class="active"':''?> href="<?=$arItem3["LINK"]?>"><?=$arItem3["TEXT"]?></a>
                            </li>
                        <?}?>
                    </ul>
                    <?}?>
                </li>
            <?}?>
        </ul>
        <?}?>
    </li>
<?}?>
