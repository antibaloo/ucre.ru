<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?//echo '<pre>';print_r($arResult['ITEMS']);echo '</pre>';?>

<?if(!count($arResult['ITEMS'])) return;?>

<div class="grid-row">

<?$i=0;$grid_row=0;foreach($arResult['ITEMS'] as $arItem){?>
    <?
    $this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem["ID"], $arItem["DELETE_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
    ?>

    <?if($grid_row++ > 1){?>
        </div><div class="grid-row">
    <?$grid_row=0;}?>

    <div class="col-lg-6 col-sm-6 cont-item" data-mark="<?=$i+1?>" id="<?=$this->GetEditAreaId($arItem["ID"])?>">
        <a  class="title" onclick="myClick(<?=$i++?>);" data-address="<?=htmlspecialcharsbx($arItem['PROPERTIES']['CITY']['VALUE'].' '.$arItem['PROPERTIES']['ADDRESS']['VALUE'])?>"><?=$arItem['NAME']?></a>

        <div class="time">
        <?if($arItem['PROPERTIES']['WORKTIME']['VALUE']){?>
            <?=nl2br($arItem['PROPERTIES']['WORKTIME']['VALUE'])?>
        <?}?>
        <?if($arItem['PROPERTIES']['PHONE']['VALUE']){?>
            <div class="phone"><?=nl2br($arItem['PROPERTIES']['PHONE']['VALUE'])?></div>
        <?}?>
        </div>

        <a href="mailto:<?=trim($arItem['PROPERTIES']['EMAIL']['VALUE'])?>"><?=trim($arItem['PROPERTIES']['EMAIL']['VALUE'])?></a>
        <div class="hidden-inf">
            <div class="inf">
                <?if($picture = $arItem['PROPERTIES']['PICTURE']['VALUE']){?>
                    <?$file = CFile::ResizeImageGet($picture, array('width'=>156, 'height'=>136), BX_RESIZE_IMAGE_EXACT, true); ?>
                    <div class="parts bg">
                        <img src="<?=$file['src']?>">
                    </div>
                <?}?>
                <div class="parts lt">
                    <div class="desc">
                        <b><?=$arItem['PROPERTIES']['CITY']['VALUE']?> <?=$arItem['PROPERTIES']['ADDRESS']['VALUE']?></b><br>
                        <?if($arItem['PROPERTIES']['WORKTIME']['VALUE']){?>
                            <?=nl2br($arItem['PROPERTIES']['WORKTIME']['VALUE'])?>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?}?>

</div>

<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/assets/js/infoBox.js"></script>
<script>

  var map;
    var elevator;
	var geocoder;
	 var infoWindows = [];
	var markers = [];
	var adr2 = [];

    var myOptions = {
       zoom: 1,
		center: new google.maps.LatLng(0, 0),
		disableDefaultUI: true,
		scaleControl: true,
		panControl: true,
		zoomControl: true,
		scrollwheel: false,
		maxZoom:18	
    };
	
	
	function initialize() {
		geocoder = new google.maps.Geocoder();	
		map = new google.maps.Map($('#map')[0], myOptions);	
		$('.cont-item').each(function(){codeAddress($(this))});
	}
	function codeAddress(addressElement) {
	
		var bounds = new google.maps.LatLngBounds ();
				var item = addressElement;			
				var myAdress = item.find('.title').text();
				var mark = item.attr('data-mark').toString();
				var content = item.find('.hidden-inf').html();			
				
				geocoder.geocode( { 'address': myAdress}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						var image = {
							 url: '<?=SITE_TEMPLATE_PATH?>/assets/images/map-icon.png',
							origin: new google.maps.Point(0, 0),
							anchor: new google.maps.Point(34, 58)
						}
						var str = results[0].formatted_address;
						
						var infowindow = new google.maps.InfoWindow({});
						var p = results[0].geometry.location;
						var latlng = new google.maps.LatLng(p.lat, p.lng);
						var marker = new google.maps.Marker({
								position: p,
								map: map,
								icon: '<?=SITE_TEMPLATE_PATH?>/assets/images/map-icon.png',
								clickable: true
							});
							
						markers.push(marker);
						
						adr2.push(results[0].geometry.location);						
						for (var i = 0, LtLgLen = adr2.length; i < LtLgLen; i++) {
						  bounds.extend(adr2[i]);
						}
						map.fitBounds (bounds);
						
						google.maps.event.addDomListener(window, 'resize', function() {
							map.fitBounds (bounds);
						});
					
						var  infowindow  = new InfoBox({	
								 content: content
								,disableAutoPan: false
								,maxWidth: 0
								,pixelOffset: new google.maps.Size(-184, -205)
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
								
						infoWindows.push(infowindow); 
								
								google.maps.event.addListener(marker, 'click', function() {
										closeAllInfoWindows();
										infowindow.open(map, this);									
								});
								
							function closeAllInfoWindows() {
							  for (var i=0;i<infoWindows.length;i++) {
								 infoWindows[i].close();
							  }
							}	 
								

						var zm = map.getZoom();
						if(zm > 18){
							map.setZoom(18);
						}
					}
				});
		
	}
	google.maps.event.addDomListener(window, 'load', initialize);
		
		
	
	
		function cC(id){
				  google.maps.event.trigger(markers[id], 'click');
			}
		function myClick(id){
			$('html, body').animate({
					scrollTop: $("#map").offset().top-56
				}, 200);			
			google.maps.event.addListenerOnce(map,'idle', cC(id));		
		
		}
</script>