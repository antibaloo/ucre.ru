<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?ob_start();?>
<?//echo '<pre>';print_r($arResult);echo '</pre>';?>
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
                <?if($arPictures = $arItem['PROPERTIES']['PICTURES']['VALUE']){?>
                    <?foreach($arPictures as $picture){?>
                        <?$file = CFile::ResizeImageGet($picture, array('width'=>660, 'height'=>435), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arWaterMark); ?>
                        <li><a class="fnc" rel="al"><img src="<?=$file['src']?>" /></a></li>
                    <?}?>
                <?}?>
            </ul>

        </div>

        <?if($arPictures = $arItem['PROPERTIES']['PICTURES']['VALUE']){?>
        <div id="bx-pager">
            <div class="bx-p">
                <?if($picture = $arResult['DETAIL_PICTURE']['ID']){?>
                    <?$file = CFile::ResizeImageGet($picture, array('width'=>104, 'height'=>72), BX_RESIZE_IMAGE_EXACT, true); ?>
                    <a data-slide-index="0" class="active" href=""><img src="<?=$file['src']?>" /></a>
                <?}?>
                <?$i=1;foreach($arPictures as $picture){?>
                    <?$file = CFile::ResizeImageGet($picture, array('width'=>104, 'height'=>72), BX_RESIZE_IMAGE_EXACT, true); ?>
                    <a data-slide-index="<?=$i++?>" href=""><img src="<?=$file['src']?>" /></a>
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
                    <?if($picture = $arResult['STAFF']['DETAIL_PICTURE']){?>
                        <?$file = CFile::ResizeImageGet($picture, array('width'=>105, 'height'=>119), BX_RESIZE_IMAGE_EXACT, true); ?>
                        <img src="<?=$file['src']?>">
                    <?}else{?>
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/stub-staff.jpg">
                    <?}?>
                </a>
                <div class="desc">
                    <div class="tb-wr">
                        <div class="tb-row">
                            <a href="<?=$arResult['STAFF']['DETAIL_PAGE_URL']?>" class="title"><?=$arResult['STAFF']['NAME']?></a>
                            <div class="ph"><?=nl2br($arResult['STAFF']['PROPERTY_PHONE_VALUE'])?></div>
                            <div class="sot-mail"><a href="mailto:<?=$arResult['STAFF']['PROPERTY_EMAIL_VALUE']?>"><?=$arResult['STAFF']['PROPERTY_EMAIL_VALUE']?></a></div>
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
        <a class="nw-map " onclick="displayMap()" data-item="data2"><span><?=GetMessage('CE_TAB_3')?></span></a>
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
            <div class="tov-addr" data-addr="<?=htmlspecialcharsbx($arItem['PROPERTIES']['CITY']['VALUE'].' '.$arItem['PROPERTIES']['ADDRESS']['VALUE'])?>"><?=$arItem['PROPERTIES']['ADDRESS']['VALUE']?></div>
            <div id="map"></div>
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

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/assets/js/infoBox.js"></script>
<script type="text/javascript">
    var map;
    var elevator;
    var geocoder;
    var markers = [];
	var p;

    var myOptions = {
        zoom: 17,
        center: new google.maps.LatLng(0, 0),
        disableDefaultUI: true,
        scaleControl: true,
        panControl: false,
        zoomControl: true,
        scrollwheel: false,
		maxZoom:18
		
		
    };
    function initialize() {
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map($('#map')[0], myOptions);
        codeAddress();
    }
    function codeAddress() {
        var adr2 = [];
        var bounds = new google.maps.LatLngBounds ();
        $('.tov-addr').each(function(){
            var myAdress =  $(this).data('addr');
            var content =  $(this).html();

            geocoder.geocode( { 'address': myAdress}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var image = {
                        url: '<?=SITE_TEMPLATE_PATH?>/assets/images/map-icon.png',
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(34, 58)
                    }
                    var str = results[0].formatted_address;

                    var infowindow = new google.maps.InfoWindow({});
                   p = results[0].geometry.location;
                    var latlng = new google.maps.LatLng(p.lat, p.lng);
                    var marker = new google.maps.Marker({
                        position: p,
                        map: map,						
                        icon: '<?=SITE_TEMPLATE_PATH?>/assets/images/map-icon.png',
                        clickable: true
                    });

                    markers.push(marker);
                    google.maps.event.addDomListener(window, 'resize', function() {
                        if(map.getZoom() > 17){
							map.setZoom(17);
						}
						map.setCenter(p); 
                    });
                    var  infowindow  = new InfoBox({
                        content: content
                        ,disableAutoPan: false
                        ,maxWidth: 0
                        ,pixelOffset: new google.maps.Size(-110, -145)
                        ,zIndex: null
                        ,boxStyle: {
                            background: "#738396"
                            ,closeBoxMargin: "10px"
                        }
                        ,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
                        ,infoBoxClearance: new google.maps.Size(1, 1)
                        ,isHidden: false
                        ,pane: "floatPane"
                        ,enableEventPropagation: false
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map, this);
                    });
					map.setCenter(p);
					
                }
            });
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
   function displayMap(){
        setTimeout(function(){
            google.maps.event.trigger(map, 'resize');
			map.setCenter(p); 
        }, 0);
		
    }
	
	
</script>

<?$this->__component->arResult["CACHED_TPL"] = ob_get_contents();
ob_get_clean();?>