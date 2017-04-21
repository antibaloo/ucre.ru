<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?//echo '<pre>';print_r($arResult['ITEMS']);echo '</pre>';?>

<div class="albums">

    <?foreach($arResult['ITEMS'] as $arItem){?>
    <?
    $this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem["ID"], $arItem["DELETE_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
    ?>
    <div class="qst-item-otz" id="<?=$this->GetEditAreaId($arItem["ID"])?>">
        <div  class="alb-item vop">


            <?if($arPictures = $arItem['PROPERTIES']['PICTURES']['VALUE']){?>

            <div class="img-otz">

                    <div class="num"><?=count($arPictures)?></div>

                    <?foreach($arPictures as $picture){?>
                        <?$file = CFile::ResizeImageGet($picture, array('width'=>371, 'height'=>371), BX_RESIZE_IMAGE_EXACT, true); ?>
                        <?$file_big = CFile::ResizeImageGet($picture, array('width'=>1024, 'height'=>1024), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                        <a class="ot-fns" href="<?=$file_big['src']?>" rel="otz"><img src="<?=$file['src']?>"></a>
                    <?}?>
            </div>

            <?}?>


            <div class="al-arrow"><span></span></div>
            <div class="otziv-middle"><div><span><div class="o-name"><?=$arItem['PROPERTIES']['NAME']['VALUE']?></div> <div class="o-date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></div> </span></div></div>

        </div>
        <div class="qst-body">
            <?=nl2br($arItem['PROPERTIES']['TEXT']['VALUE'])?>
            <br>Адресат:
            <?$res = CIBlockElement::GetByID($arItem['PROPERTIES']['STAFF']['VALUE']);?>
            <?if($ar_res = $res->GetNext()){?>
              <a href="<?=$ar_res['DETAIL_PAGE_URL']?>" class="title"><span><?=$ar_res['NAME']?></span></a>
            <?}else{?>
              <a href="http://ucre.ru/staff" class="title"><span>коллектив ЕЦН</span></a>
            <?}?>
        </div>
    </div>
    <?}?>

    <?=$arResult['NAV_STRING']?>
</div>