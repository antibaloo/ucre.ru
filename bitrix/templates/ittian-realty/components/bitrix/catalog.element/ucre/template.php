<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?ob_start();?>
<? //echo '<pre>'; print_r($arResult);echo '</pre>';?>
<?
$arItem = $arResult;
?>
<div class="top-card">
    <div class="left-card">
        <div class="tovsl-wrap">
			<a class="t-left"></a>
			<a class="t-right"></a>
            <ul class="tov-slider">
                <?
                if($arParams['WATERMARK_TEXT'])
                {
                    $arWaterMark = Array(
                        array(
                            "name" => "watermark",
                            "position" => $arParams['WATERMARK_POSITION']?$arParams['WATERMARK_POSITION']:"bottomright",
                            'type'=>'text',
                            'text' => $arParams['WATERMARK_TEXT'],
                            "coefficient"    => "4",
                            'color' => '#dedede',
                            'alpha_level' => 10,
                            'font' => $_SERVER["DOCUMENT_ROOT"] . '/bitrix/templates/ittian-realty/assets/fonts/ProximaNovaRegular/ProximaNovaRegular.ttf'
                        )
                    );
                }
                elseif($arParams['WATERMARK_FILE'])
                {
                    $arWaterMark = Array(
                        array(
                            "name" => "watermark",
                            "position" => $arParams['WATERMARK_POSITION']?$arParams['WATERMARK_POSITION']:"bottomright",
                            "type" => "image",
                            "size" => "real",
                            "file" => $_SERVER["DOCUMENT_ROOT"].$arParams['WATERMARK_FILE'],
                            "fill" => "exact",
                        )
                    );
                }else{
                    $arWaterMark = false;
                }
                ?>
                <?if($picture = $arResult['DETAIL_PICTURE']['ID']){?>
				<?$file = CFile::ResizeImageGet($picture, array('width'=>660, 'height'=>435), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arWaterMark); ?>

                <li><a class="fnc" rel="al"><img src="<?=$file['src']?>" /></a></li>
                <?}?>
                <?if($arPictures = $arItem['PROPERTIES']['LINKS_TO_PICS']['VALUE']){?>
                    <?foreach($arPictures as $picture){?>
                        <li><a class="fnc" rel="al"><img height='435' width='auto' src="<?=$picture?>" /></a></li>
                    <?}?>
                <?}?>
            </ul>

        </div>

        <?if($arPictures = $arItem['PROPERTIES']['LINKS_TO_PICS']['VALUE']){?>
        <div id="bx-pager">
            <div class="bx-p">
                <?if($picture = $arResult['DETAIL_PICTURE']['ID']){?>
				<?$file = CFile::ResizeImageGet($picture, array('width'=>104, 'height'=>72), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); ?>
                    <a data-slide-index="0" class="active" href=""><img src="<?=$file['src']?>" /></a>
                <?}?>
                <?$i=0;foreach($arPictures as $picture){?>
                    <a data-slide-index="<?=$i++?>" href=""><img width ='auto' height='72' src="<?=$picture?>" /></a>
                <?}?>
            </div>
        </div>
        <?}?>
    </div>
    <div class="right-card">
        <?if($arItem['PROPERTIES']['PRICE']['VALUE']){?>
        <div class="price">
            <?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'],0,'.', ' ')?>
            <?=GetMessage('CURRENCY')?>
        </div>
        <?}?>
        <a href="<?=SITE_DIR?>favorite/" class="otl otl-elem" data-id="<?=$arResult['ID']?>" data-gold="<?=htmlspecialcharsbx(GetMessage('CE_FAVORITE_DONE'))?>" data-to_gold="<?=htmlspecialcharsbx(GetMessage('CE_FAVORITE_ADD'))?>"><span></span><t><?=GetMessage('CE_FAVORITE_ADD')?></t></a>
        <br>
        <!--noindex-->
        <a href="<?=$arResult['DETAIL_PAGE_URL']?>?print=Y" target="_blank" class="print"><span></span><?=GetMessage('CE_PRINT')?></a>
        <!--/noindex-->

        <div class="tov-buttons">
            <!--#forms-->

            <a class="button gr cr"><?=GetMessage('CE_CALC_CREDIT')?></a>
            <div class="cr-wr ">
                <a class="close-cr"></a>
                <div class="credit-filt">
                    <h3><?=GetMessage('CE_CALC_CREDIT')?></h3>
                    <div class="filt-row">
                        <div class="filt-top">
                            <div class="desc"><?=GetMessage('CE_CALC_PRICE')?></div>
                            <div class="filt-right">
                                <div class="filt-add">
                                    <?=GetMessage('CURRENCY')?>
                                </div>
                                <input type="text" class="filt-sum sum1" value="<?=$arItem['PROPERTIES']['PRICE']['VALUE']?>">
                            </div>
                        </div>
                        <div class="filt-slider" start-data="0" stop-data="10000000" step-data="1" ></div>
                    </div>
                    <div class="filt-row">
                        <div class="filt-top">
                            <div class="desc"><?=GetMessage('CE_CALC_BEGIN')?></div>
                            <div class="filt-right">
                                <div class="filt-add">%</div>
                                <input type="text" class="filt-sum sum2" value="25">
                            </div>
                        </div>
                        <div class="filt-slider" start-data="0" stop-data="100" step-data="1" value="25"></div>
                    </div>
                    <div class="filt-row">
                        <div class="filt-top">
                            <div class="desc"><?=GetMessage('CE_CALC_PERIOD')?></div>
                            <div class="filt-right">
                                <div class="filt-add"><?=GetMessage('CE_CALC_YEAR')?></div>
                                <input type="text" class="filt-sum mydays" value="15">
                            </div>
                        </div>
                        <div class="filt-slider" start-data="0" stop-data="50" step-data="1" value="15"></div>
                    </div>
                    <div class="filt-row">
                        <div class="filt-top">
                            <div class="desc"><?=GetMessage('CE_CALC_RATE')?></div>
                            <div class="filt-right">
                                <div class="filt-add"><?=GetMessage('CE_CALC_PERCENT')?></div>
                                <input type="text" class="filt-sum year" value="13.5">
                            </div>
                        </div>
                        <div class="filt-slider dec" start-data="0" stop-data="100" step-data="0.5" value="13.5"></div>
                    </div>
                </div>
                <div class="final">
                    <div class="filt-top">
                        <div class="desc"><?=GetMessage('CE_CALC_SUM')?></div>
                        <div class="filt-right">
                            <div class="filt-add">
                                <?=GetMessage('CURRENCY')?>
                            </div>
                            <div class="f-sum">0</div>
                        </div>
                    </div>
                    <div class="filt-top">
                        <div class="desc"><?=GetMessage('CE_CALC_MONTH_SUM')?></div>
                        <div class="filt-right">
                            <div class="filt-add">
                                <?=GetMessage('CURRENCY')?>
                            </div>
                            <div class="f-month">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?if($arResult['STAFF']){?>
        <div class="sotr-mini">
            <h2><?=GetMessage('CE_STAFF_TITLE')?></h2>
            <div class="cart-min">
                <a href="<?=$arResult['STAFF']['DETAIL_PAGE_URL']?>" class="img">
                    <?if($arResult['STAFF']['PROPERTY_PHOTO_LINK_VALUE']){?>
                        <?$file = CFile::ResizeImageGet($picture, array('width'=>105, 'height'=>119), BX_RESIZE_IMAGE_EXACT, true); ?>
                        <img  height="auto" width ="105" src="<?=$arResult['STAFF']['PROPERTY_PHOTO_LINK_VALUE']?>">
                    <?}else{?>
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/stub-staff.jpg">
                    <?}?>
                </a>
                <div class="desc">
                    <div class="tb-wr">
                        <div class="tb-row">
                            <a href="<?=$arResult['STAFF']['DETAIL_PAGE_URL']?>" class="title"><?=$arResult['STAFF']['NAME']?></a>
                            <div class="ph">+7(932) 536-01-57</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
				<script type="text/javascript">(function() {
						if (window.pluso)if (typeof window.pluso.start == "function") return;
  					if (window.ifpluso==undefined) { window.ifpluso = 1;
    				var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    				s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    				s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    				var h=d[g]('body')[0];		
    				h.appendChild(s);
  			}})();</script>
<div class="pluso" data-background="transparent" data-options="small,round,line,horizontal,counter,theme=08" data-services="facebook,vkontakte,odnoklassniki,twitter,google,moimir"></div>
        <?}else{?>
        <div class="sotr-mini">
            <h2>Ответственный сотрудник</h2>
            <div class="cart-min">
                <a href="#" class="img">
									<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/stub-staff.jpg">
                </a>
                <div class="desc">
                    <div class="tb-wr">
                        <div class="tb-row">
                            <a href="#" class="title">Дежурный клиент менеджер</a>
                            <div class="ph">+7(922)829-90-57</div>
                            <div class="sot-mail"><a href="mailto:info@ucre.ru">info@ucre.ru</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
				
				<?}?>
    </div>
</div>
<div class="new-big-block">
    <div class="new-big-thumbs">
        <a class="nw-inf active" data-item="data1"><span><?=GetMessage('CE_TAB_1')?></span></a>
        <a class="nw-cred" data-item="data3"><span><?=GetMessage('CE_TAB_2')?></span></a>
        <a class="nw-map " data-item="data2"><span><?=GetMessage('CE_TAB_3')?></span></a>
    </div>
    <div class="new-big-body">
        <div class="new-data active" id="data1">
            <table>
                <?foreach($arResult['DISPLAY_PROPERTIES'] as $arProp){?>
                    <tr>
                        <td><?=$arProp['NAME']?></td>
                        <td><?=$arProp['DISPLAY_VALUE']?></td>
                    </tr>
                <?}?>
            </table>
        </div>
        <div class="new-data " id="data3">
            <?=$arResult['DETAIL_TEXT']?>
        </div>
        <div class="new-data " id="data2">            
					<div id="map">
						<?$APPLICATION->IncludeComponent("bitrix:map.yandex.view",".default",Array(
        				"INIT_MAP_TYPE" => "HYBRID",
        				"MAP_DATA" => serialize(array(
       						'yandex_lat' => $arItem['PROPERTIES']['LATITUDE']['VALUE'], // координаты центра карты
       						'yandex_lon' => $arItem['PROPERTIES']['LONGITUDE']['VALUE'], // используем координаты последнего маркера
       						'yandex_scale' => 16, // масштаб карты 0-20
       						'PLACEMARKS' => array(array(
										"LON" => $arItem['PROPERTIES']['LONGITUDE']['VALUE'],
										"LAT" => $arItem['PROPERTIES']['LATITUDE']['VALUE'],
										"TEXT" => $arItem['NAME'],
										)
									) // подготовленный ранее массив маркеров
       					)),
        				"MAP_WIDTH" => "auto",
        				"MAP_HEIGHT" => "600",
        				"CONTROLS" => array(
            			"TOOLBAR",
            			"ZOOM",
            			"SMALLZOOM",
            			"MINIMAP",
            			"TYPECONTROL",
            			"SCALELINE"
        				),
        				"OPTIONS" => array(
            		"ENABLE_SCROLL_ZOOM",
            		"ENABLE_DBLCLICK_ZOOM",
            		"ENABLE_DRAGGING"
        			),
        			"MAP_ID" => "yam_1"
    				)
					);?>
				</div>
      </div>

    </div>
</div>

<script>
    var favorite = BX.localStorage.get('favorite');
    if(favorite){
        favorite.forEach(function(id) {
            $('.otl-elem[data-id='+id+']').addClass('gold');
            $('.otl-elem[data-id='+id+'] t').text($('.otl-elem[data-id='+id+']').data('gold'));
        });
    }
</script>


<?
ob_start();
$GLOBALS['arrFilter_similar'] = array('ID'=>$arResult['PROPERTIES']['SIMILAR']['VALUE']);
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "realty",
    Array(
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "SECTION_ID" => "",
        "SECTION_CODE" => '',
        "SECTION_USER_FIELDS" => array(""),
        "ELEMENT_SORT_FIELD" => '',
        "ELEMENT_SORT_ORDER" => 'asc',
        "FILTER_NAME" => "arrFilter_similar",
        "INCLUDE_SUBSECTIONS" => "Y",
        "SHOW_ALL_WO_SECTION" => "Y",
        "SECTION_URL" => "",
        "DETAIL_URL" => "",
        "BASKET_URL" => "/personal/basket.php",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "SECTION_ID_VARIABLE" => "",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "ADD_SECTIONS_CHAIN" => "N",
        "DISPLAY_COMPARE" => "N",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "PAGE_ELEMENT_COUNT" => '',
        "LINE_ELEMENT_COUNT" => "3",
        "PROPERTY_CODE" => array("STAFF"),
        "OFFERS_LIMIT" => "",
        "PRICE_CODE" => array(""),
        "USE_PRICE_COUNT" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_PROPERTIES" => array(),
        "USE_PRODUCT_QUANTITY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "main",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "CONVERT_CURRENCY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "ELEMENT_SORT_FIELD2" => "",
        "ELEMENT_SORT_ORDER2" => "",
        "HIDE_NOT_AVAILABLE" => "N",
        "OFFERS_FIELD_CODE" => array(""),
        "OFFERS_PROPERTY_CODE" => array(""),
        "OFFERS_SORT_FIELD" => "SORT",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_FIELD2" => "",
        "OFFERS_SORT_ORDER2" => "",
        "SET_META_KEYWORDS" => "Y",
        "SET_META_DESCRIPTION" => "Y",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "OFFERS_CART_PROPERTIES" => array(),
        "ITEMS_ONLY"=>"Y"
    ),
    $component,
    array("HIDE_ICONS" => "Y")
);
$similar = ob_get_contents();
ob_get_clean();
?>
<?if($similar != ''){?>
<h3><?=GetMessage('CE_SIMILAR')?></h3>
<div class="slider-spec inner">
    <div class="sl" id="spec-main">
        <?=$similar?>
    </div>
</div>
<?}?>
<?$this->__component->arResult["CACHED_TPL"] = ob_get_contents();
ob_get_clean();
																					?>