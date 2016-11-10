<?php
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
if(CModule::IncludeModule('iblock')){
  $json = file_get_contents('php://input');
  $news = json_decode($json);
  $arSelect = array("ID", "IBLOCK_ID", "DETAIL_PICTURE");
  $arFilter = array("IBLOCK_ID"=>8, 'EXTERNAL_ID' =>$news->ID);
  $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
  
  if ($ob = $res->GetNextElement()){//Уже есть такая новость -> Обновляем
    $arFields = $ob->GetFields();
    $ID = $arFields['ID'];
    $new_pic_md5 = md5_file($news->DETAIL_PICTURE);
    $path = "http://ucre.ru".CFile::GetPath($arFields['DETAIL_PICTURE']);
    $old_pic_md5 = md5_file($path);
    $el = new CIBlockElement;
    $data = array(
      'IBLOCK_ID'         =>  8,
      'CODE'              =>  $news->ID,
      'ACTIVE'            =>  $news->ACTIVE,
      'ACTIVE_FROM'       =>  ConvertTimeStamp(time(), "SHORT"),
      'NAME'              =>  $news->NAME,
      'TAGS'              =>  $news->TAGS,
      'PREVIEW_TEXT'      =>  $news->PREVIEW_TEXT,
      'PREVIEW_TEXT_TYPE' =>  'html',
      'DETAIL_TEXT'       =>  $news->DETAIL_TEXT,
      'DETAIL_TEXT_TYPE'  =>  'html',
      'EXTERNAL_ID'       =>  $news->ID,
    );
    if ($new_pic_md5 != $old_pic_md5){//если md5 присланной и существующей картинки не совпадает, удаляем текущую и загружаем новую, в противном случае ничего не делаем.
      CFile::Delete($arFields['DETAIL_PICTURE']);
      $data['DETAIL_PICTURE'] = CFile::MakeFileArray($news->DETAIL_PICTURE);
    }
    if($el->Update($ID, $data))
      echo json_encode(array('TIMESTAMP' => ConvertTimeStamp(time(), "FULL"),'RESULT'=>'OK','ID'=>$ID, 'PICTURE' =>($new_pic_md5 != $old_pic_md5)?"CHANGED":"STAY"), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    else
      echo json_encode(array('TIMESTAMP' => ConvertTimeStamp(time(), "FULL"),'RESULT'=>'ERROR','TEXT'=>$el->LAST_ERROR), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    /*Запись в лог полученного json массива данных*/
    $log_json = fopen('getnewsfrombpm.log', 'a');
    fwrite( $log_json, $json ."\r\n");
    fclose( $log_json );
  /*--------------------------------------------*/
  }else{                            //Такой новости нет -> Создаем
    $el = new CIBlockElement;
    $data = array(
      'IBLOCK_ID'         =>  8,
      'CODE'              =>  $news->ID,
      'ACTIVE'            =>  $news->ACTIVE,
      'ACTIVE_FROM'       =>  ConvertTimeStamp(time(), "SHORT"),
      'NAME'              =>  $news->NAME,
      'TAGS'              =>  $news->TAGS,
      'DETAIL_PICTURE'    =>  CFile::MakeFileArray($news->DETAIL_PICTURE),
      'PREVIEW_TEXT'      =>  $news->PREVIEW_TEXT,
      'PREVIEW_TEXT_TYPE' =>  'html',
      'DETAIL_TEXT'       =>  $news->DETAIL_TEXT,
      'DETAIL_TEXT_TYPE'  =>  'html',
      'EXTERNAL_ID'       =>  $news->ID,
    );
    if($ID = $el->Add($data))
      echo json_encode(array('TIMESTAMP' => ConvertTimeStamp(time(), "FULL"),'RESULT'=>'OK','ID'=>$ID), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    else
      echo json_encode(array('TIMESTAMP' => ConvertTimeStamp(time(), "FULL"),'RESULT'=>'ERROR','TEXT'=>$el->LAST_ERROR), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $log_json = fopen('getnewsfrombpm.log', 'a');
    fwrite( $log_json, $json ."\r\n");
    fclose( $log_json );
  }
}
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_after.php");
?>