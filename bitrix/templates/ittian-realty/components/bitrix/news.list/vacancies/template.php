<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?ob_start();?>

<?//echo '<pre>';print_r($arResult['ITEMS']);echo '</pre>';?>

<div class="albums vac">
    <?foreach($arResult['ITEMS'] as $arItem){?>
    <?
    $this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem["ID"], $arItem["DELETE_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
    ?>
    <div class="qst-item" id="<?=$this->GetEditAreaId($arItem["ID"])?>">
        <a class="alb-item vop">
            <div class="vac-arrow"></div>
            <div class="middle">
                <div><span><?=$arItem['NAME']?></span></div>
                <div class="black"><span><div class="mini"><?=GetMessage('NL_VAC_SALARY')?></div> <b><?=$arItem['PROPERTIES']['PAY']['VALUE']?></b></span></div>
            </div>
        </a>
        <div class="qst-body">
            <?if(trim($arItem['PROPERTIES']['REQ']['VALUE']['TEXT']) != ''){?>
                <div class="col-lg-6 col-sm-6 pad">
                    <h3><?=GetMessage('NL_VAC_REQ')?></h3>
                    <?=$arItem['PROPERTIES']['REQ']['~VALUE']['TEXT']?>
                </div>
            <?}?>
            <?if(trim($arItem['PROPERTIES']['RESP']['VALUE']['TEXT']) != ''){?>
            <div class="col-lg-6 col-sm-6">
                <h3><?=GetMessage('NL_VAC_RESP')?></h3>
                <?=$arItem['PROPERTIES']['RESP']['~VALUE']['TEXT']?>
            </div>
            <?}?>

            <?if(trim($arItem['PROPERTIES']['COND']['VALUE']['TEXT']) != ''){?>
                <div class="col-lg-6 col-sm-6">
                    <h3><?=GetMessage('NL_VAC_COND')?></h3>
                    <?=$arItem['PROPERTIES']['COND']['~VALUE']['TEXT']?>
                </div>
            <?}?>

            <div class="vac-final">
                <?
                $items[] = array('ID'=>$arItem["ID"],'NAME'=>$arItem['NAME']) ;
                ?>
                <!--#forms_<?=$arItem["ID"]?>#-->
            </div>
        </div>
    </div>
    <?}?>

    <?=$arResult['NAV_STRING']?>
</div>

<?$this->__component->arResult["CACHED_TPL"] = ob_get_contents();
ob_get_clean();

$this->__component->arResult["ITEMS"] = $items;
?>