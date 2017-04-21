<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo '<pre>';print_r($arResult);echo '</pre>';?>

<div class="search-wrap">
    <div class="search-body-big">
        <form method="get" action="<?=$arResult['URL']?>">
            <input type="search" name="q" placeholder="¬ведите запрос" value="<?=htmlspecialcharsbx($arResult['REQUEST']['~QUERY'])?>">
            <button type="submit" class="sr-but"></button>
        </form>
    </div>

    <?if(count($arResult["SEARCH"])>0){?>
    <ul>
        <?foreach($arResult["SEARCH"] as $arItem){?>
        <li>
            <a href="<?=str_replace('index.php','',$arItem["URL_WO_PARAMS"])?>" class="sr-title"><?=$arItem["TITLE_FORMATED"]?></a>
            <div class="sr-desc"><?=$arItem["BODY_FORMATED"]?></div>
            <a href="<?=str_replace('index.php','',$arItem["URL_WO_PARAMS"])?>" class="some-link">&gt;&gt;&gt;</a>
        </li>
        <?}?>
    </ul>
        <?=$arResult["NAV_STRING"]?>
    <?}else{?>
        <p>
            <b><?=GetMessage('SEARCH_RESULT_NO_TEXT')?></b>
        </p>
    <?}?>
</div>






