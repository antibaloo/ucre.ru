<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?//echo '<pre>';print_r($arResult);echo '</pre>';?>

<?=$arResult['DESCRIPTION']?>

<div class="albums podr">
    <?foreach($arResult['ITEMS'] as $arItem){?>
        <?
        $this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem["ID"], $arItem["DELETE_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
        ?>
    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="alb-item" id="<?=$this->GetEditAreaId($arItem["ID"])?>">
        <div class="img">
            <?if($picture = $arItem['DETAIL_PICTURE']){?>
                <?$file = CFile::ResizeImageGet($picture, array('width'=>120, 'height'=>120), BX_RESIZE_IMAGE_EXACT, true); ?>
                <img src="<?=$file['src']?>">
            <?}?>
            <div class="num"></div>
        </div>
        <div class="al-arrow"><span></span></div>
        <div class="middle"><div><span><?=$arItem['NAME']?></span></div></div>

    </a>
    <?}?>
</div>