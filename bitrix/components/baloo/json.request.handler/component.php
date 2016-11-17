<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$input = file_get_contents('php://input');
if($input){
  $request = json_decode($input);
  $data = array(
    'TIMESTAMP' =>  ConvertTimeStamp(time(), "FULL"),
    'PARAM1'    =>  str_replace("send", "recieve", $request->PARAM1),
    'PARAM2'    =>  str_replace("send", "recieve", $request->PARAM2),
    'PARAM3'    =>  str_replace("send", "recieve", $request->PARAM3),
    'PARAM4'    =>  str_replace("send", "recieve", $request->PARAM4)
  );
  echo json_encode($data);
  $log_request = fopen('request.log', 'a');
  fwrite( $log_request, $json ."\r\n");
  fclose( $log_request );
} else{
  header( 'Location: http://ucre.ru/404.php' );
}
?>