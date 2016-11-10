<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>

<?//echo '<pre>';print_r($arResult);echo '</pre>';?>

<div class="news-wrap inner">

    <?$first = true;?>
    <?foreach($arResult['ITEMS'] as $arItem){?>
        <?
        $this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem["ID"], $arItem["DELETE_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
        ?>

        <?if($first /*&& $picture = $arItem['PREVIEW_PICTURE']*/){$open_div = true; $first = false;?>
            <?$file = CFile::ResizeImageGet($picture, array('width'=>662, 'height'=>345), BX_RESIZE_IMAGE_EXACT, true); ?>
        <div class="nw-first">
          <img src="/upload/medialibrary/62c/62ccc58c9e387353aa180a83bfaa34df.jpg">
          <!--
            <img src="<?=$file['src']?>">
-->
        <?}?>

        <div href="" class="nw-item" id="<?=$this->GetEditAreaId($arItem["ID"])?>">
            <div class="nw-body">
                <div class="title">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" ><?=$arItem['NAME']?></a>
                </div>
                <?=$arItem["PREVIEW_TEXT"]?>

            </div>
            <div class="nw-footer">
                <a class="click" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><span></span></a>
                <div class="date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></div>
            </div>
        </div>

        <?if($open_div){ $open_div = false;?>
        </div>
        <?}?>

    <?}?>


    <?=($arParams['HIDE_PAGER'] == 'Y') ? '' : $arResult['NAV_STRING']?>
</div>