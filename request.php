<?php
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
?>
<h1>
  Страница с которой отправляется json запрос на удаленный ресурс, на котором будет произведена обработка исходного запроса и в значения всем параметров будет вместо "send" 
  подставлено "recieve", а время отправки будет заменено на время получения запроса
</h1>
<?
//адрес, куда будет отправляться запрос
$url = "http://ucre.ru/answer.php";
//Массив данных, которые будут передаваться на удаленную страницу
$data = array( 
  'TIMESTAMP' =>  ConvertTimeStamp(time(), "FULL"),
  'PARAM1'    =>  'PARAM1_send',
  'PARAM2'    =>  'PARAM2_send',
  'PARAM3'    =>  'PARAM3_send',
  'PARAM4'    =>  'PARAM4_send',
);
$options = array(
  'http' => array(
    'method'  => 'POST',
    'content' => json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ),
    'header'=>  "Content-Type: application/json\r\n"."Accept: application/json\r\n"
  )
);
$context  = stream_context_create($options);
$result = file_get_contents( $url, false, $context );
$response = json_decode( $result );
?>
Запрос:
<pre>
<?print_r($data)?>
</pre>
Ответ:
<pre>
<?print_r($response)?>
</pre>
<?
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_after.php");
?>