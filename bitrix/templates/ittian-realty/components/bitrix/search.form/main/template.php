<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

<?//echo '<pre>';print_r($arResult);echo '</pre>';?>

<form method="get" action="<?=$arResult["FORM_ACTION"]?>">
    <input type="search" autocomplete="off" id="search-block-input" name="q" placeholder="<?=GetMessage("FORMSEARCH_PLACEHOLDER")?>" value="">
    <button type="submit" class="sr-but"></button>
</form>



