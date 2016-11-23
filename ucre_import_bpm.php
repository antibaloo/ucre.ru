<?php
/*---------------------------------------------------------*/
//Функция для агента на сайт, синхронизирующая объекты 
//на сайте ucre.ru с объектами на портале bpm.ucre.ru/crm/ro/
//Абалаков А.С., Единый Центр Недвижимости г. Оренбург
//455-786|55-81-01|a.s.abalakov@ucre.ru|baloo2000@mail.ru
/*---------------------------------------------------------*/
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
$start = microtime(true);
$num = 0;
$update = 0;
$new =0;
$error_add = 0;
$error_update = 0;
if(CModule::IncludeModule('iblock')) {
  $objects = json_decode(file_get_contents('https://bpm.ucre.ru/ro.json'));//Получаем вектор активных объектов портала
  foreach ($objects as $ro){
    $arFields = array();
    $arFields['IBLOCK_ID'] = 14;
    $arFields['ACTIVE'] = 'Y';
    $prop = array();
    $links = array();
    $mds = array();
    $arFields['NAME'] = html_entity_decode($ro->NAME);
    $arFields['DETAIL_TEXT'] = htmlspecialchars_decode($ro->DESCRIPTION);
    $arFields['DETAIL_TEXT_TYPE'] = 'html';
    $arFields['CODE'] = $ro->ID;
    $prop[78] = $ro->REGION;
    $prop[80] = $ro->DISTRICT;
    $prop[37] = $ro->CITY;
    $prop[38] = $ro->ADDRESS;
    $prop[39] = $ro->AREA;
    $prop[40] = $ro->SQUARE;
    $prop[92] = $ro->LIVING;
    $prop[93] = $ro->KITCHEN;
    $prop[41] = $ro->ROOMS;
    $prop[42] = $ro->FLOOR;
    $prop[43] = $ro->FLOORS;
    $prop[44] = $ro->TYPE_HOUSE;
    if ($ro->TYPE == "Продам") {
      $prop[46] = 13;
    }else {
      $prop[46] = 14;
    }
    switch ($ro->APPOINTMENT){
      case "Бизнес-центр":
        $prop[47] = 15;
        break;
      case "Гараж":
        $prop[47] = 16;
        break;
      case "Гостиница":
        $prop[47] = 17;
        break;
      case "Иное":
        $prop[47] = 18;
        break;
      case "Магазин":
        $prop[47] = 24;
        break;
      case "Отдельно стоящее здание":
        $prop[47] = 25;
        break;
      case "Офис":
        $prop[47] = 26;
        break;
      case "Помещение свободного назначения":
        $prop[47] = 27;
        break;
      case "Предприятие питания":
        $prop[47] = 28;
        break;
      case "Производственно-промышленное помещение":
        $prop[47] = 29;
        break;
      case "Склад":
        $prop[47] = 30;
        break;
      case "Торговый центр":
        $prop[47] = 31;
        break;
    }
    $prop[48] = ($ro->PLOT == "0.00")? "":$ro->PLOT;
    $prop[87] = $ro->LATITUDE;
    $prop[88] = $ro->LONGITUDE;
    $prop[51] = floatval($ro->PRICE);
    /*Поиск ответственного сотрудника*/
    $user_res = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>13,"CODE"=>$ro->ASSIGNED_BY),false,false, array("ID","IBLOCK_ID","CODE"));
    if ($uRes = $user_res->GetNext()){
      $prop[50] =$uRes['ID'];
    } else{
      $prop[50] = 2732;
    }
    /*-----------------------*/

    foreach ($ro->PHOTOS as $link){
      $links[] = $link;
    }
    foreach ($ro->PLANS as $link){
      $links[] = $link;
    }
    foreach ($ro->MD5 as $md){
      $mds[] = $md;
    }
    $prop[83] = $links;
    $prop[89] = $mds;
    
    $arFields['PROPERTY_VALUES'] = $prop;
    $arSelect = Array("ID", "IBLOCK_ID", "CODE");
    $iblock_filter = array ("IBLOCK_ID" => 14, "CODE"=>$ro->ID);
    $db_res = CIBlockElement::GetList(array("ID" => "DESC"), $iblock_filter, false, false, $arSelect);//Проверяем, есть ли на сайте объект с CODE = id объекта с портала
    $object = new CIBlockElement;
    if($aRes = $db_res->GetNext()){//Есть такой объект - обновляем
      echo "Обновляем объект ".$aRes['ID']." следующими данными:";
      print_r($arFields);
      echo "<br>";
      if ($object->Update($aRes['ID'], $arFields)){
        $update++;
      } else {
        $error_update++;
      }
    }else{//Нет такого объекта - создаем
      if ($ro->NEW_BUILDING == "Y") {
        $arFields['IBLOCK_SECTION_ID'] = 22;
      }else {
        switch ($ro->RO_TYPE){
          case 381:
          case 382:
            $arFields['IBLOCK_SECTION_ID'] = 20;
            break;
          case 383:
          case 384:
          case 385:
          case 386:
            $arFields['IBLOCK_SECTION_ID'] = 24;
            break;
          case 387:
            $arFields['IBLOCK_SECTION_ID'] = 23;
            break;
        }
      }
      if ($object->Add($arFields)){
        $new++;
      } else {
        $error_add++;
      }
    }
    $num++;
  }
  $time = microtime(true) - $start;
  CEventLog::Add(array(
    "SEVERITY" => "SECURITY",
    "AUDIT_TYPE_ID" => "IMPORT_BPM",
    "MODULE_ID" => "main",
    "ITEM_ID" => 'Каталог недвижимости',
    "DESCRIPTION" => "Обработано: ".$num." объектов за ".$time." секунд из них обновлено: ".$update.", новых: ".$new.". Ошибок при обновлении - ".$error_update.", ошибок при добавлении - ".$error_add,
  ));
}
echo "Обработано: ".$num." объектов за ".$time." секунд из них обновлено: ".$update.", новых: ".$new.". Ошибок при обновлении - ".$error_update.", ошибок при добавлении - ".$error_add;
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_after.php");
?>