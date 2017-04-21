<?
$MESS['HEADER_FAVORITE'] = 'Избранное';
$MESS['HEADER_REALTY_CATALOG'] = 'Каталог недвижимости';
$MESS['HEADER_BACK'] = 'Назад';

$MESS['CURRENCY'] =  COption::GetOptionString('ittian.realty', 'CURRENCY') != 'other'?
    '<span class="roub">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 328 368.5" enable-background="new 0 0 328 368.5" xml:space="preserve">
        <path d="M204.3,237.6c79.6,0,123.8-54.7,123.8-118.8C328,54.1,284.4,0,204.3,0H31.9v281.7H0v42.6h31.9v44.3h78.5v-44.3h156.3v-42.6
            H110.3v-44.1H204.3z M110.3,69.1h83.4c30.9,0,54.1,18.8,54.1,49.7c0,30.4-23.2,49.7-54.1,49.7h-83.4V69.1z"/>
        </svg>
    </span>'
    :COption::GetOptionString('ittian.realty', 'CURRENCY_HTML');


?>