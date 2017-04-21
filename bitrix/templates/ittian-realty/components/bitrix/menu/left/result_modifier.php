<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if ( !function_exists("getChilds") )
{
    function getChilds($input, &$start = 0, $level = 0) {
        if(!$level){
            $lastDepthLevel = 1;
            if(is_array($input)){
                foreach($input as $i => $arItem){
                    if($arItem["DEPTH_LEVEL"] > $lastDepthLevel){
                        if($i > 0){
                            $input[$i - 1]["IS_PARENT"] = 1;
                        }
                    }
                    $lastDepthLevel = $arItem["DEPTH_LEVEL"];
                }
            }
        }
        $childs = array();
        $count = count($input);
        for($i = $start; $i < $count; $i++) {
            $item = $input[$i];
            if($level > $item['DEPTH_LEVEL'] - 1) {
                break;
            } elseif(!empty($item['IS_PARENT'])) {
                $i++;
                $item['CHILD'] = getChilds($input, $i, $level+1);
                $i--;
            }
            $childs[] = $item;
        }
        $start = $i;
        return $childs;
    }
}

$arResult = getChilds($arResult);


