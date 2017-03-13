<?php
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
/*---------------------------------------------------------*/
//Функция для агента на сайт для выгрузки объектов в формате
//xml на сайт irr.ru
//Абалаков А.С., Единый Центр Недвижимости г. Оренбург
//455-786|55-81-01|a.s.abalakov@ucre.ru|baloo2000@mail.ru
/*---------------------------------------------------------*/
$start = microtime(true);//Засекаем время выполнения скрипта
$num = 0;
if(CModule::IncludeModule('iblock')) {
  $dom = new domDocument("1.0", "utf-8");
  $users = $dom->createElement("users");
  $dom->appendChild($users);
  $user = $dom->createElement("user");
  $user->setAttribute("deactivate-untouched","false");
  $users->appendChild($user);
  $match = $dom->createElement("match");
  $user->appendChild($match);
  $user_id = $dom->createElement("user-id","20462501");
  $match->appendChild($user_id);
  $arSort= Array("ID"=>"ASC");
  $arSelect = Array("ID","IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_TEXT", "IBLOCK_SECTION_ID","PROPERTY_*");
  $arFilter = Array("IBLOCK_ID" => 14, "ACTIVE"=>"Y", "!SECTION_ID"=>21, "PROPERTY_78"=>"Оренбургская обл");
  $db_res =  CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
  while($ob=$db_res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    if ($arProps['PRICE']['VALUE']=="0" || $arProps['PRICE']['VALUE']==""){
      continue;
    }
    if ($arFields['DETAIL_TEXT']=="Номер в базе: ".$arFields['ID']){
      continue;
    }
    $store_ad = $dom->createElement("store-ad");
    $store_ad->setAttribute("validtill",date("c",strtotime("+2 days")));
    $store_ad->setAttribute("power-ad","1");
    $store_ad->setAttribute("source-id",$arFields['ID']);
    switch ($arFields['IBLOCK_SECTION_ID']){
      case 22:
        $store_ad->setAttribute("category","/real-estate/apartments-sale/new");
        $store_ad->setAttribute("advertype","realty_new");
        break;
      case 20:
        $name = explode(" ",$arFields['NAME']);
        if ($name[0]=="Комната" || $name[0]=="комната" ) {
          $store_ad->setAttribute("category",($arProps['TYPE']['VALUE']=='Продажа')?"/real-estate/rooms-sale":"/real-estate/rooms-rent");
          $store_ad->setAttribute("advertype",($arProps['TYPE']['VALUE']=='Продажа')?"realty_rooms_sell":"realty_rooms_rent");
        }
        if ($name[1]=="квартира") {
          $store_ad->setAttribute("category",($arProps['TYPE']['VALUE']=='Продажа')?"/real-estate/apartments-sale/secondary":"/real-estate/rent");
          $store_ad->setAttribute("advertype",($arProps['TYPE']['VALUE']=='Продажа')?"realty_sell":"realty_rent");
        }
        break;
      case 24:
        $name = explode(" ",$arFields['NAME']);
        if ($name[1]=="дом" || $name[1]=="таунхаус" || $name[0]=="Дача"){
          $store_ad->setAttribute("category",($arProps['TYPE']['VALUE']=='Продажа')?"/real-estate/out-of-town/houses":"/real-estate/out-of-town-rent");
          $store_ad->setAttribute("advertype",($arProps['TYPE']['VALUE']=='Продажа')?"realty_house":"realty_house_rent");
        }
        if ($name[0]=="Участок"){
          $store_ad->setAttribute("category","/real-estate/out-of-town/lands");
          $store_ad->setAttribute("advertype","realty_land");
        }
        break;
      case 23:
        $name = explode(" ",$arFields['NAME']);
        if ($name[0]=="Гостиница" || $name[0]=="Иное" || $name[0]=="Помещение"){
          $store_ad->setAttribute("category",($arProps['TYPE']['VALUE']=='Продажа')?"/real-estate/commercial-sale/misc":"/real-estate/commercial/misc");
          $store_ad->setAttribute("advertype",($arProps['TYPE']['VALUE']=='Продажа')?"realty_comm_other":"realty_comm_other_rent");
        }
        if ($name[0]=="Предприятие"){
          $store_ad->setAttribute("category",($arProps['TYPE']['VALUE']=='Продажа')?"/real-estate/commercial-sale/eating":"/real-estate/commercial/eating");
          $store_ad->setAttribute("advertype",($arProps['TYPE']['VALUE']=='Продажа')?"realty_bar":"realty_bar_rent");
        }
        if ($name[0]=="Офис" || $name[0]=="Офисное"){
          $store_ad->setAttribute("category",($arProps['TYPE']['VALUE']=='Продажа')?"/real-estate/commercial-sale/offices":"/real-estate/commercial/offices");
          $store_ad->setAttribute("advertype",($arProps['TYPE']['VALUE']=='Продажа')?"realty_office_sell":"realty_office_rent");
        }
        if ($name[0]=="Производственно-промышленное" || $name[0]=="Склад"){
          $store_ad->setAttribute("category",($arProps['TYPE']['VALUE']=='Продажа')?"/real-estate/commercial-sale/production-warehouses":"/real-estate/commercial/production-warehouses");
          $store_ad->setAttribute("advertype",($arProps['TYPE']['VALUE']=='Продажа')?"realty_warehouse":"realty_warehouse_rent");
        }
        if ($name[0]=="Отдельно"){
          $store_ad->setAttribute("category",($arProps['TYPE']['VALUE']=='Продажа')?"/real-estate/commercial-sale/houses":"/real-estate/commercial/houses");
          $store_ad->setAttribute("advertype",($arProps['TYPE']['VALUE']=='Продажа')?"realty_houses_comm":"realty_houses_comm_rent");
        }
        if ($name[0]=="Магазин"){
          $store_ad->setAttribute("category",($arProps['TYPE']['VALUE']=='Продажа')?"/real-estate/commercial-sale/retail":"/real-estate/commercial/retail");
          $store_ad->setAttribute("advertype",($arProps['TYPE']['VALUE']=='Продажа')?"realty_trading":"realty_trading_rent");
        }
        if ($name[0]=="Гараж"){
          $store_ad->setAttribute("category",($arProps['TYPE']['VALUE']=='Продажа')?"/real-estate/garage/stall":"/real-estate/garage-rent/stall");
          $store_ad->setAttribute("advertype",($arProps['TYPE']['VALUE']=='Продажа')?"realty_trading":"realty_trading_rent");
        }
        break;
    }
    $custom_fields = $dom->createElement("custom-fields");
    $region = $dom->createElement("field", substr($arProps['REGION']['VALUE'], 0, strrpos($arProps['REGION']['VALUE'], ' ')));//substr($arProps['REGION']['VALUE'], 0, strrpos($arProps['REGION']['VALUE'], ' '));
    $region->setAttribute("name","region");
    $custom_fields->appendChild($region);
    if ($arProps['DISTRICT']['VALUE']!=""){
      $district = $dom->createElement("field", substr($arProps['DISTRICT']['VALUE'], 0, strrpos($arProps['DISTRICT']['VALUE'], ' ')));
      $district->setAttribute("name","address_area");
      $custom_fields->appendChild($district);
    }
    $city_name = substr($arProps['CITY']['VALUE'], 0, strrpos($arProps['CITY']['VALUE'], ' '));
    switch ($city_name){
      case "Нежинский":
        $city_name="Нежинка";
        break;
    }
    $city = $dom->createElement("field", $city_name);
    $city->setAttribute("name","address_city");
    $custom_fields->appendChild($city);
    if ($arProps['AREA']['VALUE']!=""){
      $area = $dom->createElement("field", $arProps['AREA']['VALUE']);
      $area->setAttribute("name","address_district");
      $custom_fields->appendChild($area);
    }
    $str_arr = explode(",",$arProps['ADDRESS']['VALUE']);
    $street = $dom->createElement("field", $str_arr[0]);
    $street->setAttribute("name","address_street");
    $custom_fields->appendChild($street);
    if (trim($str_arr[1])!=""){
      $house = $dom->createElement("field", trim($str_arr[1]));
      $house->setAttribute("name","address_house");
      $custom_fields->appendChild($house);
    }
    if ($arProps['LATITUDE']['VALUE']!=""){
      $lat = $dom->createElement("field", $arProps['LATITUDE']['VALUE']);
      $lat->setAttribute("name","geo_lat");
      $custom_fields->appendChild($lat);
    }
    if ($arProps['LONGITUDE']['VALUE']!=""){
      $lng = $dom->createElement("field", $arProps['LONGITUDE']['VALUE']);
      $lng->setAttribute("name","geo_lng");
      $custom_fields->appendChild($lng);
    }
    
    $name = explode(" ",$arFields['NAME']);
    if ($name[1]=="квартира") {
      $rooms = $dom->createElement("field", $arProps['ROOMS']['VALUE']);
      $rooms->setAttribute("name","rooms");
      $custom_fields->appendChild($rooms);
      
      $meters_t = $dom->createElement("field", $arProps['SQUARE']['VALUE']);
      $meters_t->setAttribute("name","meters-total");
      $custom_fields->appendChild($meters_t);
      
      $etage = $dom->createElement("field", $arProps['FLOOR']['VALUE']);
      $etage->setAttribute("name","etage");
      $custom_fields->appendChild($etage);
      
      $etage_a = $dom->createElement("field", $arProps['FLOORS']['VALUE']);
      $etage_a->setAttribute("name","etage-all");
      $custom_fields->appendChild($etage_a);  
    }
    
    if ($name[1]=="дом"){
      $object = $dom->createElement("field", "дом");
      $object->setAttribute("name","object");
      $custom_fields->appendChild($object);
    }
    if ($name[1]=="таунхаус"){
      $object = $dom->createElement("field", "таун-хаус");
      $object->setAttribute("name","object");
      $custom_fields->appendChild($object);
    }
    if ($name[0]=="Дача"){
      $object = $dom->createElement("field", "дача");
      $object->setAttribute("name","object");
      $custom_fields->appendChild($object);
    }
    if ($name[1]=="дом" || $name[1]=="таунхаус" || $name[0]=="Дача"){
      $meters_t = $dom->createElement("field", $arProps['SQUARE']['VALUE']);
      $meters_t->setAttribute("name","meters-total");
      $custom_fields->appendChild($meters_t);
      
      $land= $dom->createElement("field", $arProps['HECTARE']['VALUE']);
      $land->setAttribute("name","land");
      $custom_fields->appendChild($land);
    }
    
    
    /*Поиск данных риелтора*/
    /* с 13.03.2017 все объявления выгружаются под общми контактными данными
    */
    $contact = $dom->createElement("field","Единый Центр Недвижимости");
    $contact->setAttribute("name","contact");
    $custom_fields->appendChild($contact);
    $email = $dom->createElement("field","info@ucre.ru");
    $email->setAttribute("name","email");
    $custom_fields->appendChild($email);
    $phone = $dom->createElement("field","+7(3532)690-157, +7(932)536-01-57");
    $phone->setAttribute("name","phone");
    $custom_fields->appendChild($phone);
    /*
    $stSort= Array("ID"=>"ASC");
    $stSelect = Array("ID","IBLOCK_ID", "NAME", "PROPERTY_*");
    $stFilter = Array("IBLOCK_ID" => 13, "ACTIVE"=>"Y", "ID"=>$arProps['STAFF']['VALUE']);
    $st_res =  CIBlockElement::GetList($stSort, $stFilter, false, false, $stSelect);
    if($st=$st_res->GetNextElement()){
      $stFields = $st->GetFields();
      $stProps = $st->GetProperties();	
      $contact = $dom->createElement("field",$stFields['NAME']);
      $contact->setAttribute("name","contact");
      $custom_fields->appendChild($contact);
      $email = $dom->createElement("field",$stProps['EMAIL']['VALUE']);
      $email->setAttribute("name","email");
      $custom_fields->appendChild($email);
      $phone = str_replace(" ","",$stProps['PHONE']['VALUE']);
      $phone = str_replace("(","",$phone);
      $phone = str_replace(")","",$phone);
      $phone = str_replace("-","",$phone);
      $phone = $dom->createElement("field",$phone);
      $phone->setAttribute("name","phone");
      $custom_fields->appendChild($phone);
    }*/
    /*----------------------*/
    $res = CIBlockSection::GetByID($arFields['IBLOCK_SECTION_ID']);
    if($ar_res = $res->GetNext()){
      $web = $dom->createElement("field", "http://ucre.ru/catalog/".$ar_res['CODE']."/".$arFields['ID']."/");
      $web->setAttribute("name","web");
      $custom_fields->appendChild($web);
    }
    
    
    
    
    $store_ad->appendChild($custom_fields);
    
    $price = $dom->createElement("price");
    $price->setAttribute("value",intval($arProps['PRICE']['VALUE']));
    if (!intval($arProps['PRICE']['VALUE'])) echo "Без цены http://ucre.ru/catalog/".$ar_res['CODE']."/".$arFields['ID']."/<br>";
    $price->setAttribute("currency","RUR");
    $store_ad->appendChild($price);
    $title = $dom->createElement("title",$arFields['NAME']);
    $store_ad->appendChild($title);
    $description = $dom->createElement("description",html_entity_decode($arFields['DETAIL_TEXT']));
    $store_ad->appendChild($description);
    
    $fotos = $dom->createElement("fotos");
    //print_r($arProps['MD5']);
    //echo "<br>";
    foreach($arProps['LINKS_TO_PICS']['VALUE'] as $key=>$link){
      if ($key==10) break;
      $foto_remote = $dom->createElement("foto-remote");
      $foto_remote->setAttribute("url",$link);
      $foto_remote->setAttribute("md5",$arProps['MD5']['VALUE'][$key]);
      $fotos->appendChild($foto_remote);
    }
    $store_ad->appendChild($fotos);
    $user->appendChild($store_ad);
    $num++;
  }
  $dom->save("/home/bitrix/ucre.ru/orenburg_irr.xml"); // Сохраняем полученный XML-документ в файл
  $time = microtime(true) - $start;
  CEventLog::Add(array(
    "SEVERITY" => "SECURITY",
    "AUDIT_TYPE_ID" => "IRR",
    "MODULE_ID" => "main",
    "ITEM_ID" => 'Каталог недвижимости',
    "DESCRIPTION" => "Обработано: ".$num." объектов за ".$time." секунд",
  ));
  echo "Обработано: ".$num." объектов за ".$time." секунд";
}

require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_after.php");
?>