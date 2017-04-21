<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?//echo '<pre>';print_r($arResult);echo '</pre>';?>
<?CModule::IncludeModule("ittian.realty")?>

<div class="news-wrap inner usl">
    <?foreach($arResult['SECTIONS'] as $arItem){?>
        <div class="nw-item">
            <div class="nw-body">
                <div class="title">
                    <a href="<?=$arItem['SECTION_PAGE_URL']?>" ><?=$arItem['NAME']?></a>
                </div>
                <?=$arItem['DESCRIPTION']?>
            </div>
            <div class="nw-footer">
                <a href="<?=$arItem['SECTION_PAGE_URL']?>" class="click"><span></span></a>
                <div class="date">
                    <?if($arItem['ELEMENT_CNT']){?>
                    <?=$arItem['ELEMENT_CNT']?> <?=CRealty::GetWordForm($arItem['ELEMENT_CNT'],GetMessage('CSL_SERVICE_1'),GetMessage('CSL_SERVICE_2'),GetMessage('CSL_SERVICE_5'))?>
                    <?}?>
                </div>
            </div>
        </div>
    <?}?>
</div>
