<?php
/*---------------------------------------------------------*/
//Функция для скрипта, запускаемого по расписанию, для синхронизации данных о жилых комплексах с сайтом http://orenburg.new-stroyka.ru/
//Абалаков А.С., Единый Центр Недвижимости г. Оренбург 455-786|55-81-01|a.s.abalakov@ucre.ru|baloo2000@mail.ru
/*---------------------------------------------------------*/
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://orenburg.new-stroyka.ru/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Opera/10.0 (Windows NT 5.1; U; en");
$result = curl_exec($ch);

$avito_result = fopen('/home/bitrix/ucre.r/avito.html', 'w');
fwrite( $avito_result, $result);
fclose( $avito_result );

require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_after.php");
?>