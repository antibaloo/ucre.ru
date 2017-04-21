<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>

<div class="albums">
    <?foreach($arResult['ITEMS'] as $arItem){?>
        <?
        $this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem["ID"], $arItem["DELETE_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
        ?>
        <div class="qst-item" id="<?=$this->GetEditAreaId($arItem["ID"])?>">
            <a class="alb-item vop">
                <div class="quest"></div>
                <div class="al-arrow"><span></span></div>
                <div class="middle">
                    <div>
                        <span>
                            <?=nl2br($arItem['PROPERTIES']['QUESTION']['VALUE'])?>
                        </span>
                    </div>
                </div>
            </a>
            <div class="qst-body">
                <?=nl2br($arItem['PROPERTIES']['ANSWER']['VALUE'])?>
            </div>
        </div>
    <?}?>

    <?=$arResult['NAV_STRING']?>

</div>
