<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?//echo '<pre>';print_r($arResult);echo '</pre>';?>

<div class="uslugi ">
    <div class="grid-row ">
        <?foreach($arResult['SECTIONS'] as $arItem){?>
        <div class="col-sm-4">
            <a href="<?=$arItem['SECTION_PAGE_URL']?>" class="usl-item ">

                <?if($arItem['PICTURE']['ID']){?>
                    <?$file = CFile::ResizeImageGet($arItem['PICTURE']['ID'], array('width'=>340, 'height'=>176), BX_RESIZE_IMAGE_EXACT, true); ?>
                    <img src="<?=$file['src']?>" alt="" />
                <?}else{?>

                <?}?>
                <div class="title"><?=$arItem['NAME']?></div>
                <div class="desc">
                    <?=$arItem['DESCRIPTION']?>
                </div>
            </a>
        </div>
        <?}?>
    </div>
</div>
