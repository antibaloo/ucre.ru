<? 
/*---------------------------------------------------------*/
//Функция для агента на сайт, деактивирующая объекты на сайте ucre.ru 
//неактивные на портале bpm.ucre.ru/crm/ro/
//Абалаков А.С., Единый Центр Недвижимости г. Оренбург
//455-786|55-81-01|a.s.abalakov@ucre.ru|baloo2000@mail.ru
/*---------------------------------------------------------*/
function site_link(){
	$start = microtime(true);
	$num = 0;
	if(CModule::IncludeModule('iblock')) {
		$arSelect = Array("ID", "IBLOCK_ID", "CODE", "IBLOCK_SECTION_ID", "ACTIVE");
		$iblock_filter = array ("IBLOCK_ID" => 14, "ACTIVE" => "Y", "!CODE"=>false);//Есть значение  CODE
		$db_res = CIBlockElement::GetList(array("CODE"=>"ASC"), $iblock_filter, false, false, $arSelect);
		while($aRes = $db_res->GetNext()){
			$res = CIBlockSection::GetByID($aRes['IBLOCK_SECTION_ID']);
			if($ar_res = $res->GetNext()){
				$link = "http://ucre.ru/catalog/".$ar_res['CODE']."/".$aRes['ID']."/";		
			}
			file_get_contents('https://bpm.ucre.ru/pub/ro.php?link='.$link.'&id='.$aRes['CODE']);
			$num++;
		}
		$time = microtime(true) - $start;
		CEventLog::Add(array(
			"SEVERITY" => "SECURITY",
			"AUDIT_TYPE_ID" => "LINK_SYNC",
			"MODULE_ID" => "main",
			"ITEM_ID" => 'Каталог недвижимости',
			"DESCRIPTION" => "Передача ссылок на объекты на сайте на портал, передано: ".$num." объектов за ".$time." секунд",
		));
	}
	return "site_link();";
}
?>