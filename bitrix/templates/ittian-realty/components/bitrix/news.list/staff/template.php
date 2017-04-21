<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>

<?//echo '<pre>';print_r($arResult);echo '</pre>';?>

<div class="sot-wrap">

    <?foreach($arResult['SECTIONS'] as $arSection){?>

        <?if($arSection['SECTION']){?>
            <h2><?=$arSection['SECTION']['NAME']?></h2>
        <?}?>

        <?foreach($arSection['ITEMS'] as $arItem){?>
            <?
            $this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem["ID"], $arItem["DELETE_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
            ?>
            <div  class="sot-item col-lg-3  col-md-4 col-sm-6" id="<?=$this->GetEditAreaId($arItem["ID"])?>">
                <a  href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="img">
                    <?if($picture = $arItem['DETAIL_PICTURE']){?>
                        <?$file = CFile::ResizeImageGet($picture, array('width'=>374, 'height'=>421), BX_RESIZE_IMAGE_EXACT, true); ?>
                        <img src="<?=$file['src']?>">
                    <?}else{?>
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/stub-staff.jpg">
                    <?}?>
                </a>
                <div class="sot-body">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="title">
                        <?=$arItem['NAME']?>
                    </a>
                    <div class="desc"><?=$arItem['PROPERTIES']['POST']['VALUE']?></div>
                </div>
                <div class="finish">
                    <div class="sot-phone"><?=nl2br($arItem['PROPERTIES']['PHONE']['VALUE'])?></div>
                    <a href="mailto:<?=trim($arItem['PROPERTIES']['EMAIL']['VALUE'])?>"><?=$arItem['PROPERTIES']['EMAIL']['VALUE']?></a>
                </div>
            </div>
        <?}?>

    <?}?>

</div>