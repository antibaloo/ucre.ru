<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?IncludeTemplateLangFile(__FILE__);?>
<?$isIndex = CSite::inDir(SITE_DIR."index.php");?>
<!doctype html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

    <title><?$APPLICATION->ShowTitle()?></title>

    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/style.css")?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/selectizit.css")?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/jquery.nouislider.css")?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/grid.css")?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/jquery.bxslider.css")?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/jquery.fancybox.css")?>


    <!--[if IE]>
    <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/assets/css/iefix.css" />
    <![endif]-->

    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/html5.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/jquery-1.11.1.min.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/jquery.form.js')?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/jquery.placeholder.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/jquery.fancybox.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/smoothscroll.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/jquery.validate.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/jquery.dotdotdot.min.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/jquery.bxslider.min.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/dropdown.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/jquery.liblink.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/wNumb.min.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/jquery.nouislider.all.min.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/selectize.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/jquery.inputmask.bundle.min.js")?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/js/action.js")?>
		
    <?CJSCore::Init(array('ls'))?>
    <?$APPLICATION->ShowHead()?>

    <script>
        var SiteOptions = {
            SITE_DIR : '<?=SITE_DIR?>',
            clear_cache: <?=$_REQUEST['clear_cache']=='Y'?'"Y"':'""'?>
        };
    </script>

    <?if($_REQUEST['print'] == 'Y'){?>
        <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/print.css")?>
        <script>
            $(function(){
                window.print();
            });
        </script>
    <?}?>
</head>
<!--[if IE 9]>     <body class="forie"> <![endif]-->
<!--[if !IE]><!--> <body>            <!--<![endif]-->
<div id="panel"><?$APPLICATION->ShowPanel();?></div>

<?$arTheme = $APPLICATION->IncludeComponent(
    "tiangroup:site.theme",
    "",
    array(
        'MODULE_ID'=>'ittian.realty',
        'CLASS_NAME'=>'CRealty'
    ),
    false,
    array("HIDE_ICONS" => "Y")
);?>
<?
$color = $arTheme['COLOR']['VALUE'];
if($color && $color != 'default')
{
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/themes/".$color."/css/style.css");
}
$favicon_file = CRealty::GetOption('FAVICON_FILE');
if($favicon_file != ''){
    $APPLICATION->AddHeadString('<link rel="shortcut icon" href="'.$favicon_file.'" type="image/x-icon" />');
}
?>
<div class="main">
<div class="fix-dop">
	<div class="top-head" id="tov">
			<div class="wrapper grid-row">
				<div class="aside">
					<div class="as-icon"></div>
					<a href="<?=SITE_DIR?>favorite/" class="as-desc"><?=GetMessage('HEADER_FAVORITE')?> <span><d>0</d></span></a>
				</div>
			</div>
		</div>
</div>
    <div class="sidebar">
        <a class="s-back"><?=GetMessage('HEADER_BACK')?></a>
        <ul>
            <?$APPLICATION->IncludeComponent("bitrix:menu", "top", array(
                    "ROOT_MENU_TYPE" => "top",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "3600000",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MAX_LEVEL" => "3",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "Y",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N"
                ),
                false,
                array("HIDE_ICONS" => "Y")
            );?>
        </ul>
    </div>

    <header>
        <div class="top-head">
            <div class="wrapper grid-row">
                <a class="side-link"></a>
                <div class="t-nav-wrap">
                    <ul class="t-nav">
                        <?$APPLICATION->IncludeComponent("bitrix:menu", "top", array(
                                "ROOT_MENU_TYPE" => "top",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600000",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "3",
                                "CHILD_MENU_TYPE" => "left",
                                "USE_EXT" => "Y",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N"
                            ),
                            false
                        );?>
                    </ul>
                </div>
                <div class="aside">
                    <div class="as-icon"></div>
                    <a href="<?=SITE_DIR?>favorite/" class="as-desc"><?=GetMessage('HEADER_FAVORITE')?> <span><d>0</d></span></a>
                </div>
                <script>
                    var favorite = BX.localStorage.get('favorite');
                    if(favorite && favorite.length > 0){
                        $('.as-desc span d').text(favorite.length);
                    }
                </script>
            </div>
        </div>
        <div class="middle-head<?=$isIndex?'':' inner'?>">
            <div class="wrapper grid-row">
                <div class="col-sm-3 logo-wrap">
                    <?
                    $logo_file = CRealty::GetOption('LOGO_FILE');
                    if($logo_file == ''){
                        $logo_file = SITE_TEMPLATE_PATH.'/assets/images/logo.png';
                    }
                    ?>
                    <a class="logo " href="<?=SITE_DIR?>"><img src="<?=$logo_file?>"></a>
                </div>
                <div class="mid-b col-sm-6">
                    <?$APPLICATION->IncludeFile(SITE_DIR."include/header_contacts_data.php", Array(), Array("MODE"=>"text","SHOW_BORDER"=>false));?>

                </div>
                <div class="top-btn col-sm-3">
                    <a href="<?=SITE_DIR?>request/" class="button"><?$APPLICATION->IncludeFile(SITE_DIR."include/request_btn.php", Array(), Array("MODE"=>"text"));?></a>
                </div>
            </div>
        </div>
        <div class="bottom-head<?=$isIndex?'':' inner'?>">
            <div class="wrapper">
                <a class="m-menu"><?=GetMessage('HEADER_REALTY_CATALOG')?><span></span></a>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/header_realty_menu.php", Array(), Array("MODE"=>"text","SHOW_BORDER"=>false));?>
            </div>
        </div>
    </header>

<?if(!$isIndex){?>
    <div class="wrapper">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", array(
                "START_FROM" => "1",
                "PATH" => "",
                "SITE_ID" => SITE_ID
            ),
            false
        );?>

        <h1><?$APPLICATION->ShowTitle(false)?></h1>
    </div>

    <div class="content">

        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "sect",
                "AREA_FILE_SUFFIX" => "top",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => ""
            ),
            false,
            array("HIDE_ICONS" => "Y")
        );?>

        <div class="wrapper<?=$arTheme['SECTIONS']['INNER_SIDE']['VALUE']=='left'?' onleft':''?>">

            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "sect",
                    "AREA_FILE_SUFFIX" => "aside",
                    "AREA_FILE_RECURSIVE" => "Y",
                    "EDIT_TEMPLATE" => ""
                ),
                false,
                array("HIDE_ICONS" => "Y")
            );?>

            <div class="left">

<?}?>
