<?if(!$isIndex){?>

            </div>

        </div>
    </div>
<?}?>


<div class="break"></div>
</div>
<footer>
    <div class="top-foot">
        <div class="wrapper">
            <div class="foot-row">
                <div class="left-menu col-lg-8">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "footer", array(
                            "ROOT_MENU_TYPE" => "top",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "3600000",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "",
                            "USE_EXT" => "N",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N"
                        ),
                        false
                    );?>
                </div>
                <div class="search-body col-lg-4" id="search-block">
                    <?$APPLICATION->IncludeComponent("bitrix:search.form", "main", Array(
                            "USE_SUGGEST" => "N",
                            "PAGE" => SITE_DIR."search/",
                        ),
                        false,
                        array('HIDE_ICONS' => 'Y')
                    );?>
                    <?$APPLICATION->IncludeFile(SITE_DIR."include/search_title.php", Array(), Array("MODE"=>"html"));?>
                </div>
            </div>
            <div class="foot-row">
                <div class="copy col-lg-8">
                    <?$APPLICATION->IncludeFile(SITE_DIR."include/inc_copyright.php", Array(), Array("MODE"=>"text"));?>
                </div>
                <div class="soc col-lg-4" >
                    <div class="left col-lg-5">
                        <?$APPLICATION->IncludeFile(SITE_DIR."include/inc_ss_title.php", Array(), Array("MODE"=>"html"));?>
                    </div>
                    <div class="right col-lg-7">
                        <?$APPLICATION->IncludeFile(SITE_DIR."include/inc_ss.php", Array(), Array("MODE"=>"text"));?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter37082475 = new Ya.Metrika({
                    id:37082475,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/37082475" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<link rel="stylesheet" href="https://cdn.callbackkiller.com/widget/cbk.css">
<script type="text/javascript" src="https://cdn.callbackkiller.com/widget/cbk.js?wcb_code=6d2c8fa41f50f9ec01177bb28c659612" charset="UTF-8" async></script>
<!-- Rating@Mail.ru counter -->
<script type="text/javascript">
  var _tmr = window._tmr || (window._tmr = []);
  _tmr.push({id: "2889161", type: "pageView", start: (new Date()).getTime()});
  (function (d, w, id) {
    if (d.getElementById(id)) return;
    var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
    ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
    var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
    if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
  })(document, window, "topmailru-code");
</script><noscript><div>
<img src="//top-fwz1.mail.ru/counter?id=2889161;js=na" style="border:0;position:absolute;left:-9999px;" alt="" />
</div></noscript>
<!-- //Rating@Mail.ru counter -->
<!-- Открытые линии -->
<script data-skip-moving="true">
        (function(w,d,u,b){
                s=d.createElement('script');r=(Date.now()/1000|0);s.async=1;s.src=u+'?'+r;
                h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://bpm.ucre.ru/upload/crm/site_button/loader_8_0numed.js');
</script>
<!-- Открытые линии -->
</body>
</html>