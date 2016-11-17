<?php
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->IncludeComponent(
  "baloo:json.request.handler",
  "",
  array()
);
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_after.php");
?>