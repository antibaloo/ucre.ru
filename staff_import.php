<?php
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
//CModule::IncludeModule('iblock');
$start = microtime(true);//Засекаем время выполнения скрипта
$n = 0;
$u = 0;
$a = 0;
$e = 0;
$emploees = array();
$dom = new DOMDocument(); 
$dom->load('https://bpm.ucre.ru/staff.xml'); 
$Staff = $dom->documentElement;
$Agents = $Staff->childNodes;
foreach ($Agents as $Agent){
  $Fields = $Agent->childNodes;
  $emploee = array();
  foreach($Fields as $Field){
    $emploee[$Field->nodeName] = $Field->nodeValue;
  }
  $n++;
  $emploees[] = $emploee;
}

if(CModule::IncludeModule('iblock')) {
  $arSelect = array("ID", "IBLOCK_ID", "ACTIVE");
  $arFilter = Array("IBLOCK_ID" => 13, "ACTIVE" => "Y");
  $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
  while($ob = $res->GetNextElement()){  
    $arFields = $ob->GetFields();
    $el = new CIBlockElement;
    $arStaffArray = array(
      "IBLOCK_ID"         => 13,
      "ACTIVE"            => "N",            // деактивация всех сотрудников перед загрузкой нового списка
    );
    $el->Update($arFields['ID'], $arStaffArray);
  }   
  foreach($emploees as $emploee){
    $arSelect = array("ID", "IBLOCK_ID", "CODE", "SORT", "NAME", "ACTIVE", "IBLOCK_SECTION_ID", "POST", "PHONE","EMAIL", "PHOTO_LINK");
    $arFilter = Array("IBLOCK_ID" => 13, "CODE" => $emploee['Id']);
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    if ($ob = $res->GetNextElement()){
      $arFields = $ob->GetFields();
      $arProps = $ob->GetProperties();
      
      $el = new CIBlockElement;
      $arStaffArray = array(
        "IBLOCK_ID"         => 13,
        "NAME"              => $emploee['FIO'],
        "ACTIVE"            => "Y",            // активен
        "SORT"              => ($emploee['Rating'])?$emploee['Rating']:"",
        "CODE"              => $emploee['Id'],
      );
      if ($emploee['Best']){
        $arStaffArray['IBLOCK_SECTION_ID'] = 42;
      }else{
        switch($emploee['Department']){
          case "Руководство":
            $arStaffArray['IBLOCK_SECTION_ID'] = 17;
            break;
          case "АУП":
            $arStaffArray['IBLOCK_SECTION_ID'] = 43;
            break;
          case "Отдел продаж":
            $arStaffArray['IBLOCK_SECTION_ID'] = 18;
            break;
        }
      }
      $res = $el->Update($arFields['ID'], $arStaffArray);
      CIBlockElement::SetPropertyValuesEx(
        $arFields['ID'], 
        false, 
        array(
          'POST'        => $emploee['Position'],
          'PHONE'       => $emploee['Phone'],
          'EMAIL'       => $emploee['Email'],
          'PHOTO_LINK'  => $emploee['Photo'],
        )
      );
      $u++;
    }else{
      $el = new CIBlockElement;
      $PROP = array();
      $PROP[33] = $emploee['Position'];
      $PROP[34] = $emploee['Phone'];
      $PROP[35] = $emploee['Email'];
      $PROP[86] = $emploee['Photo'];
      $arStaffArray = array(
        "IBLOCK_ID"         => 13,
        "PROPERTY_VALUES"   => $PROP,
        "NAME"              => $emploee['FIO'],
        "ACTIVE"            => "Y",            // активен
        "SORT"              => ($emploee['Rating'])?$emploee['Rating']:"",
        "CODE"              => $emploee['Id'],
      );
      if ($emploee['Best']){
        $arStaffArray['IBLOCK_SECTION_ID'] = 42;
      }else{
        switch($emploee['Department']){
          case "Руководство":
            $arStaffArray['IBLOCK_SECTION_ID'] = 17;
            break;
          case "АУП":
            $arStaffArray['IBLOCK_SECTION_ID'] = 43;
            break;
          case "Отдел продаж":
            $arStaffArray['IBLOCK_SECTION_ID'] = 18;
            break;
        }
      }
      if($STAFF_ID = $el->Add($arStaffArray)){
        $result = "New ID: ".$STAFF_ID;
        $a++;
      }else{
        $result = "Error: ".$el->LAST_ERROR;
        $e++;
      }
    } 
  }
}
$time = microtime(true) - $start;
CEventLog::Add(array(
    "SEVERITY" => "SECURITY",
    "AUDIT_TYPE_ID" => "STAFF_IMPORT",
    "MODULE_ID" => "main",
    "ITEM_ID" => 'Список сотрудников',
    "DESCRIPTION" => "Загружено ".$n." сотрудников, из них ".$u." - обновлено, ".$a." - добавлено (".$e." - ошибок обработки)  за ".$time." секунд.",
  ));
echo "Загружено ".$n." сотрудников, из них ".$u." - обновлено, ".$a." - добавлено (".$e." - ошибок обработки)  за ".$time." секунд.";

require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_after.php");
?>