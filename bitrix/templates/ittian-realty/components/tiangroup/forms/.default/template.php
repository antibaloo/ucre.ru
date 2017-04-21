<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>

<?//echo '<pre>';print_r($arResult);echo '</pre>';?>


<div class="tg-forms<?=$arParams['FORM_POSITION'] == 'form'?' back-form':''?>">
    <?if($arParams['FORM_POSITION'] != 'form'){?>
    <a class="button frm"><?=$arResult['TITLE_FORM']?$arResult['TITLE_FORM']:'&nbsp;'?></a>
    <?}?>

    <div class="inner-done">
        <a class="close-dn"></a>
        <h3><?=GetMessage('TF_THANKS')?></h3>
        <?=$arResult['SUCCESS_MESSAGE']?>
    </div>
    <div class="inner-form">

        <div class="wait">
            <div class="preloader"> <div class="spinner"></div> </div>
        </div>

        <?if($arParams['FORM_POSITION'] != 'form'){?>
        <a class="close-fr"></a>
        <?}?>
        <form action="<?=$arResult['FORM_ACTION']?>" <?=$arResult['IS_FILE']?'enctype="multipart/form-data"':''?>>
            <?=bitrix_sessid_post()?>

            <?if($arParams['FORM_POSITION'] != 'form'){?>
            <h3><?=$arResult['TITLE_FORM']?></h3>
            <?}?>

            <?foreach($arResult['FIELDS'] as $arField){?>
                <?if(strpos($arField['CODE'],'HIDDEN_')=== 0 ){?>
                    <input type="hidden" name="<?=$arField['CODE']?>" value="<?=htmlspecialcharsbx($arParams['HIDDEN'][$arField['CODE']])?>">
                <? continue;}?>
                <?if(!in_array($arField['FIELD_TYPE'],array('text','html','file','list'))) continue;?>
                <div class="row">
                    <label>
                        <?=$arField['NAME']?><?=$arField['IS_REQUIRED']=='Y'?'&nbsp;<span class="orange">*</span>':''?>

                        <?if($arField['FIELD_TYPE'] == 'html'){?>
                            <textarea name="<?=$arField['CODE']?>" <?=$arField['IS_REQUIRED']=='Y'?'required':''?> ></textarea>
                        <?}elseif($arField['FIELD_TYPE'] == 'file'){?>
                            <div class="file-side">
                                <div class="file_upload">
                                    <button class="button gr file-but" type="button">Загрузить</button>
                                    <div></div>
                                    <input type="file" name="<?=$arField['CODE']?>">
                                </div>
                            </div>
                        <?}elseif($arField['FIELD_TYPE'] == 'list'){?>
                            <select name="<?=$arField['CODE']?>" <?=$arField['IS_REQUIRED']=='Y'?'required':''?>>
                                <!--option value="0">&nbsp;</option-->
                                <?foreach($arField['ENUMS'] as $arValue){?>
                                <option value="<?=$arValue['ID']?>"><?=$arValue['VALUE']?></option>
                                <?}?>
                            </select>
                        <?}else{?>
                            <input type="<?=$arField['IS_EMAIL']=='Y'?'email':'text'?>" <?=$arField['IS_REQUIRED']=='Y'?'required':''?> name="<?=$arField['CODE']?>" <?=$arField['IS_PHONE']=='Y'?'placeholder="+7 (_ _ _) _ _ _ - _ _ - _ _" class="phoneinput" pattern="^((\+[7]{1}\-\([0-9]{3}\)\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}))?$" maxlength="18" autocomplete="off"':''?>>
                        <?}?>
                    </label>
                </div>
            <?}?>


            <div class="row">

                <button class="button" type="submit" data-hash="<?=$arResult["PARAMS_HASH"]?>"><?=$arResult['SUBMIT_BUTTON']?></button>

            </div>

        </form>
    </div>
</div>