<?php
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
$start = microtime(true);//Засекаем время выполнения скрипта
$dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
  $realty_feed = $dom->createElement("realty-feed"); // Создаём корневой элемент
  $realty_feed->setAttribute("xmlns","http://webmaster.yandex.ru/schemas/feed/realty/2010-06");
  $dom->appendChild($realty_feed);//Присоединяем его к документу
  $generation_date = $dom->createElement("generation-date", date("c"));//Создаем вложенный элемент
  $realty_feed->appendChild($generation_date);//Присоединяем его к корневому
  $num = 0;
  if(CModule::IncludeModule('iblock')) {
      $arSort= Array("ID"=>"ASC");
      $arSelect = Array("ID","IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","DETAIL_PICTURE", "DETAIL_TEXT", "IBLOCK_SECTION_ID","PROPERTY_*");
      $arFilter = Array("IBLOCK_ID" => 14, "ACTIVE"=>"Y");
      $res =  CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
      while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        $temp = explode (" ",$arFields['NAME']);
				switch ($temp[0]){
					case 'Комната':
					case 'Дача'		:
					case 'Участок':
						$cat = strtolower($temp[0]);
						break;
					default:
						$cat = $temp[1];
				}
				$arProps = $ob->GetProperties();
        echo $arFields['ID']." ".$arFields['NAME']." ".$arFields['DATE_ACTIVE_FROM']." ".$arProps['STAFF']['VALUE']."<br>";
        if ($arProps['STAFF']['VALUE'] >0) {
					//----------------Поиск данных агента----------
					$agentSort = Array("ID"=>"ASC");
					$agentSelect = Array("ID","IBLOCK_ID", "NAME", "PROPERTY_*");
					$agentFilter = Array("IBLOCK_ID" => 13, "ID"=>$arProps['STAFF']['VALUE']);
					$ares = CIBlockElement::GetList($agentSort, $agentFilter, false, false, $agentSelect);
					$agent = $ares->GetNextElement();
					$agentFields = $agent->GetFields();
					$agentProps = $agent->GetProperties();
					//---------------------------------------------
				}else {
					$agentFields['ID'] = "#";
					$agentFields['NAME'] = "Дежурный клиент-менеджер";
					$agentProps['PHONE']['VALUE'] = "+7(922)829-90-57";
					$agentProps['EMAIL']['VALUE'] = "info@ucre.ru";
					$agentProps['PHOTO_LINK']['VALUE'] = "http://ucre.ru/bitrix/templates/ittian-realty/assets/images/stub-staff.jpg";
				}
        if ($arFields['IBLOCK_SECTION_ID']=='23' || $arFields['IBLOCK_SECTION_ID']=='21'){continue;}
        
        $offer = $dom->createElement("offer"); // Создаём узел "Object"
        $offer->setAttribute("internal-id",$arFields['ID']);
        $type = $dom->createElement("type",$arProps['TYPE']['VALUE']); // Создаём узел "type" с текстом внутри
        $offer->appendChild($type);// Добавляем в узел "offer" узел "type"
        
        switch ($arFields['IBLOCK_SECTION_ID']){
          case 20:
          case 22:
          case 24:
            $property_type = $dom->createElement("property-type","жилая");
            break;
        }
        $offer->appendChild($property_type);
        
        $category = $dom->createElement("category",$cat);
        $offer->appendChild($category);
        
        $link = "http://ucre.ru/catalog/";
        switch ($arFields['IBLOCK_SECTION_ID']){
          case 20:
            $link .= "residential-property/";
            break;
          case 22:
            $link .= "new-buildings/";
            break;
          case 24:
            $link .= "rural-property/";
            break;
        }
        
        $url = $dom->createElement("url",$link.$arFields['ID']);
        $offer->appendChild($url);
        
        $creation_date = $dom->createElement("creation-date",date("c"/*, strtotime($arFields['DATE_ACTIVE_FROM'])*/));
        $offer->appendChild($creation_date);
        
        $location = $dom->createElement("location");
        $country = $dom->createElement("country","Россия");
        $location->appendChild($country);
        $region = $dom->createElement("region",str_replace("обл","область",$arProps['REGION']['VALUE']));
        $location->appendChild($region);
        if ($arProps['DISTRICT']['VALUE']!=''){
          $district = $dom->createElement("district",$arProps['DISTRICT']['VALUE']);
          $location->appendChild($district);
        }
        $locality_name = $dom->createElement("locality-name",$arProps['CITY']['VALUE']);
        $location->appendChild($locality_name);
        if ($arProps['AREA']['VALUE']!=''){
          $sub_locality_name = $dom->createElement("sub-locality-name",$arProps['AREA']['VALUE']);
          $location->appendChild($sub_locality_name);      
        }
        $address = $dom->createElement("address",$arProps['ADDRESS']['VALUE']);
        $location->appendChild($address);     
        $offer->appendChild($location);
        
        $sales_agent = $dom->createElement("sales-agent");                                  //данные агента
        $name = $dom->createElement("name",$agentFields['NAME']);                           //имя
        $sales_agent->appendChild($name);
        $phone = $dom->createElement("phone",$agentProps['PHONE']['VALUE']);                //телефон
        $sales_agent->appendChild($phone);
        $category = $dom->createElement("category","агентство");                             //категория продавца
        $sales_agent->appendChild($category);
        $organization = $dom->createElement("organization","Единый Центр Недвижимости");  //нименование агентства
        $sales_agent->appendChild($organization);
        $url = $dom->createElement("url","http://ucre.ru/staff/".$agentFields['ID']);       //ссылка на страницу агента
        $sales_agent->appendChild($url);
        $email = $dom->createElement("email",$agentProps['EMAIL']['VALUE']);                //адрес электронной почты
        $sales_agent->appendChild($email);
        $photo = $dom->createElement("photo",$agentProps['PHOTO_LINK']['VALUE']);             //фото агента
        //$photo = $dom->createElement("photo",'http://ucre.ru/ucre.jpg');                    //логотип агентства

        $sales_agent->appendChild($photo);
        $offer->appendChild($sales_agent);
        
        $price = $dom->createElement("price");                                              //данные по цене
	    	$value = $dom->createElement("value", (int)($arProps['PRICE']['VALUE']));           //собственно цена
	    	$price->appendChild($value);
        $currency = $dom->createElement("currency","RUR");                                  //валюта
        $price->appendChild($currency);
        $offer->appendChild($price);
        
        $notforagents = $dom->createElement("not-for-agents",'нет');
        $offer->appendChild($notforagents);
        $haggle = $dom->createElement("haggle",'да');
        $offer->appendChild($haggle);
        $mortgage = $dom->createElement("mortgage",'да');
        $offer->appendChild($mortgage);
        
        if ($arProps['SQUARE']['VALUE']!='' and $arProps['SQUARE']['VALUE']!='0'){
          $area = $dom->createElement("area");                                              //данные по площади объекта
          $value = $dom->createElement("value", $arProps['SQUARE']['VALUE']);               //собственно площадь
          $area->appendChild($value);
          $unit = $dom->createElement("unit","кв.м");                                       //единицы измерения
          $area->appendChild($unit);
          $offer->appendChild($area);
        }
        
        //echo $arProps['TYPE']['VALUE']." ".$arProps['REGION']['VALUE']." ".$arProps['CITY']['VALUE']." ".$arProps['ADDRESS']['VALUE']." ".$arProps['STAFF']['VALUE']." ".$agentFields['NAME']."<br>";
        
        foreach ($arProps['LINKS_TO_PICS']['VALUE'] as $value){                                  //данные по остальным изображениям
          $image = $dom->createElement("image", $value);
          $offer->appendChild($image);
        }
        
        $description = $dom->createElement("description", html_entity_decode ($arFields['DETAIL_TEXT']));        //описание
        $offer->appendChild($description);
        
        if ($arProps['HECTARE']['VALUE']!=''){
          $lot_area = $dom->createElement("lot-area");                                       //данные по площади участка
          $value = $dom->createElement("value", $arProps['HECTARE']['VALUE']);               //собственно площадь
          $lot_area->appendChild($value);
          $unit = $dom->createElement("unit","сот");                                         //единицы измерения
          $lot_area->appendChild($unit);
          $offer->appendChild($lot_area);
        }
        
        if ($arFields['IBLOCK_SECTION_ID']=='22'){                                          //признак новостройки
          $new_flat = $dom->createElement("new-flat",'да');
          $offer->appendChild($new_flat);
        }
        
        if ($arProps['ROOMS']['VALUE']!='' and $arProps['ROOMS']['VALUE']!='0'){                                                 //количество комнат
          $rooms = $dom->createElement("rooms",$arProps['ROOMS']['VALUE']);
          $offer->appendChild($rooms);
        }
        if ($cat=='комната'){
					$rooms_offered = $dom->createElement("rooms-offered","1");
          $offer->appendChild($rooms_offered);
				}
				
        if ($arProps['FLOOR']['VALUE']!='' and $arProps['FLOOR']['VALUE']!='0'){                                                 //этаж
          $floor = $dom->createElement("floor",$arProps['FLOOR']['VALUE']);
          $offer->appendChild($floor);
        }
        
        if ($arProps['FLOORS']['VALUE']!='' and $arProps['FLOORS']['VALUE']!='0'){                                                 //этажность
          $floors = $dom->createElement("floors-total",$arProps['FLOORS']['VALUE']);
          $offer->appendChild($floors);
        }
        
        if ($arProps['TYPE_HOUSE']['VALUE']!=''){                                                 //этажность
          $building_type = $dom->createElement("building-type",$arProps['TYPE_HOUSE']['VALUE']);
          $offer->appendChild($building_type);
        }
        
        $realty_feed->appendChild($offer); // Добавляем в корневой узел "Objects" узел "Object"
        $num++;
      }

      $dom->save("/home/bitrix/ucre.ru/orenburg_yandex.xml"); // Сохраняем полученный XML-документ в файл
      echo "Выгружено: ".$num;
      $time = microtime(true) - $start;
      printf(' Скрипт выполнялся %.4F сек.', $time);
      CEventLog::Add(array(
         "SEVERITY" => "SECURITY",
         "AUDIT_TYPE_ID" => "YML_EXPORT",
         "MODULE_ID" => "main",
         "ITEM_ID" => 'Каталог недвижимости',
         "DESCRIPTION" => "Выгрузка агентом объектов недвижимости в формате Яндекс.Недвижимость, выгружено ".$num." объектов за ".$time." секунд",
      ));
    }
echo "Выгрузка агентом объектов недвижимости в формате Яндекс.Недвижимость, выгружено ".$num." объектов за ".$time." секунд";
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_after.php");
?>