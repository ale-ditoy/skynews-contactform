<?php
date_default_timezone_set('Europe/Zurich');

$monat = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];
$today = new Datetime();
$aboStart = new Datetime();
$aboEnd = new Datetime();

if ($today->format('j') > 10) {
    $aboStart->add(new DateInterval('P2M'));
    $aboEnd->add(new DateInterval('P13M'));
} else {
    $aboStart->add(new DateInterval('P1M'));
    $aboEnd->add(new DateInterval('P1Y'));
}

$catchaFile = 'captcha-archive.txt';
if (file_exists($catchaFile)) {
    $captchaArchive = json_decode(file_get_contents('captcha-archive.txt'));
} else {
    $captchaArchive = [];
}
$captchaLetters = ['a', 'b', 'c', 'd', 'e', 'f', 'h', 'i', 'j', 'k', 'm', 'n', 'p', 'r', 't', 'u', 'v', 'w', 'x', 'y', 'z', '2', '3', '4', '5', '7', '8'];

$captcha = "";
for ($i = 0; $i < 4; $i++) {
    $captcha .= $captchaLetters[rand(0 , count($captchaLetters) - 1 )];
}
$captchaArchive[] = $captcha;

$captchaArchive = array_slice($captchaArchive, -10, 10);
file_put_contents($catchaFile, json_encode($captchaArchive));

$htmlLayout = <<<'EOT'
<!doctype html>
<html lang=de>
<head>
<meta charset=utf-8>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kontakt &ndash; SkyNews.ch</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
<?= $content ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>

<script src="/js/bootstrap-validator.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {jQuery('#abonieren').validator()}, false);

function getRandom(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

$(function() {
    var colours = ["#000000", "#FF0000", "#990066", "#FF9966", "#996666", "#00FF00", "#CC9933"];
    var div = $('#captcha-original'); 
    var chars = div.text().split('');
    div.html('');     
    for(var i=0; i<chars.length; i++) {
        idx = getRandom(0, colours.length - 1);
        var span = $('<span>' + chars[i] + '</span>').css("color", colours[idx]).css("transform", "rotate("+getRandom(-30, 30)+"deg)").css('display', 'inline-block').css('padding-right', '2pt');
        div.append(span);
    }
});

</script>

</body>
</html>
EOT;

$htmlLayout = <<<'EOT'
<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="de-CH">
 <head>

  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.2.1.352"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.watch.js", "require.js", "abonnieren.css"], "outOfDate":[]};
</script>
  
  <title>Abonnieren</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=4025139942"/>
  <link rel="stylesheet" type="text/css" href="css/master_a-master.css?crc=3978870801"/>
  <link rel="stylesheet" type="text/css" href="css/abonnieren.css?crc=159739323" id="pagesheet"/>
  <!-- Other scripts -->
  <script type="text/javascript">
   var __adobewebfontsappname__ = "muse";
</script>
  <!-- JS includes -->
  <script type="text/javascript">
   document.write('\x3Cscript src="' + (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//webfonts.creativecloud.com/montserrat:n4:all.js" type="text/javascript">\x3C/script>');
</script>
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?crc=4241844378" type="text/javascript"></script>
  <![endif]-->
    <style>
    body {
        background-color:transparent;
    }
    h2 {
        font-size: 20px;
        color: #0071BC;
        font-weight: 700;
        margin-bottom:20px;
    }
    div.row p {
        margin-bottom:1rem;
    }
    div.footer p {
        color: #ffffff;
    }
    div.footer div.clearfix {
        left: 0px !important;
    }
    div.footer div.Bodytext {
        margin-top: 46px;
        left: 120px;
    }
    
    #captcha-original {
        font-size:21pt;
    }

   </style>
   </head>
 <body>

  <div class="clearfix" id="page"><!-- group -->
   <div class="clearfix grpelem" id="pmenuu5422"><!-- group -->
    <nav class="MenuBar clearfix" id="menuu5422"><!-- horizontal box -->
     <div class="MenuItemContainer clearfix grpelem" id="u5486"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u5487" href="index.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u5490-4"><!-- content --><p>Home</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u5444"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u5445" href="team.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u5448-4"><!-- content --><p>Team</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u5465"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u5468" href="skynews.ch.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u5471-4"><!-- content --><p>SkyNews.ch</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u5423"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u5424" href="skynews-app.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u5426-4"><!-- content --><p>SkyNews APP</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u5430"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u5431" href="skyheli.ch.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u5434-4"><!-- content --><p>SkyHeli.ch</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u5472"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u5473" href="schweizer-luftwaffe.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u5474-4"><!-- content --><p>Schweizer Luftwaffe</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u5479"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u5480" href="bilddatenbank.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u5483-4"><!-- content --><p>Bilddatenbank</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u5437"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u5440" href="kontakt.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u5442-4"><!-- content --><p>Kontakt</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u5458"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive clearfix colelem" id="u5459" href="abonnieren.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u5460-4"><!-- content --><p>Abonnieren</p></div></a>
     </div>
    </nav>
    <nav class="MenuBar clearfix" id="menuu10778"><!-- horizontal box -->
     <div class="MenuItemContainer clearfix grpelem" id="u10793"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u10796" href="index.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u10798-4"><!-- content --><p>Home</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u10800"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u10801" href="team.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u10803-4"><!-- content --><p>Team</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u10828"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u10831" href="skynews.ch.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u10833-4"><!-- content --><p>SkyNews.ch</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u10835"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u10836" href="skynews-app.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u10838-4"><!-- content --><p>SkyNews APP</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u10807"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u10808" href="skyheli.ch.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u10809-4"><!-- content --><p>SkyHeli.ch</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u10779"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u10782" href="schweizer-luftwaffe.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u10783-4"><!-- content --><p>Schweizer Luftwaffe</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u10786"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u10787" href="bilddatenbank.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u10789-4"><!-- content --><p>Bilddatenbank</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u10814"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u10815" href="kontakt.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u10816-4"><!-- content --><p>Kontakt</p></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u10821"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive clearfix colelem" id="u10824" href="abonnieren.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u10827-4"><!-- content --><p>Abonnieren</p></div></a>
     </div>
    </nav>
     <div class="clip_frame" id="u14882" data-muse-uid="U14882" data-muse-type="img_frame"><!-- image -->
      <img class="block" id="u14882_img" src="images/skynewsch-ohne%20zeile.jpg?crc=3828792672" alt="" width="703" height="112" data-muse-src="images/skynewsch-ohne%20zeile.jpg?crc=3828792672"/>
     </div>
     <!-- /m_editable -->
     <!-- m_editable region-id="editable-static-tag-U15486-BP_infinity" template="abonnieren.html" data-type="image" data-ice-options="clickable" data-ice-editable="link" -->
     <a class="nonblock nontext clip_frame" id="u15486" href="https://www.facebook.com/pages/SkyNewsch/418923408234158" target="_blank" data-muse-uid="U15486" data-muse-type="img_frame"><!-- image --><img class="block" id="u15486_img" src="images/facebook20x20.jpg?crc=447491628" alt="" width="20" height="20" data-muse-src="images/facebook20x20.jpg?crc=447491628"/></a>
     <!-- /m_editable -->
   </div>
   <div class="clearfix grpelem" id="u3550-3"><!-- content -->
    <p>&nbsp;</p>
   </div>
   <div class="browser_width" id="u5522-bw">
    <div id="u5522"><!-- simple frame --></div>
   </div>
   <div class="browser_width" id="u1583-3-bw">
    <div class="clearfix" id="u1583-3"><!-- content -->
     <p>&nbsp;</p>
    </div>
   </div>
   <div class="browser_width" id="u5523-3-bw">
    <div class="shadow clearfix" id="u5523-3"><!-- content -->
     <p>&nbsp;</p>
    </div>
   </div>
   <div class="clearfix grpelem" id="pu6244-20"><!-- column -->
    <div class="clearfix colelem" id="u6244-20"><!-- content -->
    <?= $content ?>
    </div>
    <div class="browser_width colelem" id="u201-bw">
     <div id="u201" class="footer"><!-- group -->
      <div class="clearfix" id="u201_align_to_page">
       <div class="Bodytext clearfix grpelem" id="u14648-12"><!-- content -->
        <p>Aviation Media AG<br>
        Oberteufenerstrasse 58<br>
        8428 Teufen-Zürich<br>
        T 044 881 72 61<br>
        M <a href="mailto:info@skynews.ch">info@skynews.ch</a></p>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
  <!-- Other scripts -->
  <script type="text/javascript">
   window.Muse.assets.check=function(d){if(!window.Muse.assets.checked){window.Muse.assets.checked=!0;var b={},c=function(a,b){if(window.getComputedStyle){var c=window.getComputedStyle(a,null);return c&&c.getPropertyValue(b)||c&&c[b]||""}if(document.documentElement.currentStyle)return(c=a.currentStyle)&&c[b]||a.style&&a.style[b]||"";return""},a=function(a){if(a.match(/^rgb/))return a=a.replace(/\s+/g,"").match(/([\d\,]+)/gi)[0].split(","),(parseInt(a[0])<<16)+(parseInt(a[1])<<8)+parseInt(a[2]);if(a.match(/^\#/))return parseInt(a.substr(1),
16);return 0},g=function(g){for(var f=document.getElementsByTagName("link"),i=0;i<f.length;i++)if("text/css"==f[i].type){var h=(f[i].href||"").match(/\/?css\/([\w\-]+\.css)\?crc=(\d+)/);if(!h||!h[1]||!h[2])break;b[h[1]]=h[2]}f=document.createElement("div");f.className="version";f.style.cssText="display:none; width:1px; height:1px;";document.getElementsByTagName("body")[0].appendChild(f);for(i=0;i<Muse.assets.required.length;){var h=Muse.assets.required[i],l=h.match(/([\w\-\.]+)\.(\w+)$/),k=l&&l[1]?
l[1]:null,l=l&&l[2]?l[2]:null;switch(l.toLowerCase()){case "css":k=k.replace(/\W/gi,"_").replace(/^([^a-z])/gi,"_$1");f.className+=" "+k;k=a(c(f,"color"));l=a(c(f,"backgroundColor"));k!=0||l!=0?(Muse.assets.required.splice(i,1),"undefined"!=typeof b[h]&&(k!=b[h]>>>24||l!=(b[h]&16777215))&&Muse.assets.outOfDate.push(h)):i++;f.className="version";break;case "js":k.match(/^jquery-[\d\.]+/gi)&&d&&d().jquery=="1.8.3"?Muse.assets.required.splice(i,1):i++;break;default:throw Error("Unsupported file type: "+
l);}}f.parentNode.removeChild(f);};location&&location.search&&location.search.match&&location.search.match(/muse_debug/gi)?setTimeout(function(){g(!0)},5E3):g()}};
var muse_init=function(){require.config({baseUrl:""});require(["jquery","museutils","whatinput","jquery.musemenu","jquery.watch"],function(d){var $ = d;$(document).ready(function(){try{
window.Muse.assets.check($);/* body */
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
Muse.Utils.prepHyperlinks(false);/* body */
Muse.Utils.resizeHeight('.browser_width');/* resize height */
Muse.Utils.requestAnimationFrame(function() { $('body').addClass('initialized'); });/* mark body as initialized */
Muse.Utils.fullPage('#page');/* 100% height page */
Muse.Utils.initWidget('.MenuBar', ['#bp_infinity'], function(elem) { return $(elem).museMenu(); });/* unifiedNavBar */
Muse.Utils.showWidgetsWhenReady();/* body */
Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
}catch(b){if(b&&"function"==typeof b.notify?b.notify():Muse.Assert.fail("Error calling selector function: "+b),false)throw b;}})})};

</script>
  <!-- RequireJS script -->
  <script src="scripts/require.js?crc=4108833657" type="text/javascript" async data-main="scripts/museconfig.js?crc=169177150" onload="if (requirejs) requirejs.onError = function(requireType, requireModule) { if (requireType && requireType.toString && requireType.toString().indexOf && 0 <= requireType.toString().indexOf('#scripterror')) window.Muse.assets.check(); }" onerror="window.Muse.assets.check();"></script>
   </body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<script src="/js/bootstrap-validator.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {jQuery('#abonieren').validator()}, false);

function getRandom(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

$(function() {
    var colours = ["#000000", "#FF0000", "#990066", "#FF9966", "#996666", "#00FF00", "#CC9933"];
    var div = $('#captcha-original'); 
    var chars = div.text().split('');
    div.html('');     
    for(var i=0; i<chars.length; i++) {
        idx = getRandom(0, colours.length - 1);
        var span = $('<span>' + chars[i] + '</span>').css("color", colours[idx]).css("transform", "rotate("+getRandom(-30, 30)+"deg)").css('display', 'inline-block').css('padding-right', '2pt');
        div.append(span);
    }
});

</script>
</html>

EOT;


$htmlContent = <<<'EOT'

<form method="post" action="abo-bestellung-send.php" id="abonieren" data-toggle="validator">

<div class="row">
<h2>Wählen Sie ein Abonnement</h2>

<fieldset class="form-group">
    <div class="form-check">
        <label class="form-check-label">
        <input class="form-check-input" type="radio" name="abo" value="Normal" required>
        <strong>SkyNews.ch</strong> (Print)<br>
        CHF 85.- / EUR 75.-<br>
        12 x SkyNews.ch + 1 x skyheli.ch + 1x Kalender SkyAction<br>
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
        <input class="form-check-input" type="radio" name="abo" value="Normal mit app" required>
        <strong>SkyNews.ch plus APP</strong> (Print + APP)<br>
        CHF 85.- / EUR 75.-<br>
        12 x SkyNews.ch + App für iPhone / iPad / Android
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
        <input class="form-check-input" type="radio" name="abo" value="Normal nur app" required>
        <strong>APP-Abo</strong><br>
        CHF 85.- / EUR 75.<br>
        12 x SkyNews.ch für iPhone / iPad / Android
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
        <input class="form-check-input" type="radio" name="abo" value="Combi" required>
        <strong>SkyNews.ch Kombi-Abo</strong> (Print)<br>
        CHF 96.- / EUR 85.-<br>
        12 x SkyNews.ch + 1 x skyheli.ch + 1 x Schweizer Luftwaffe + 1 x Kalender SkyAction
        </label>
    </div>
</fieldset>

<fieldset class="form-group">

    <fieldset class="form-group">
        <div class="form-group row">
            <label class="col-xs-2 col-form-label" for="abonent-name">Name</label>
            <div class="col-xs-10">
                <input type="text" class="form-control" id="abonent-name" name="name" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label" for="abonent-vorname">Vorname</label>
            <div class="col-xs-10">
                <input type="text" class="form-control" id="abonent-vorname" name="vorname" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label" for="abonent-adresse">Adresse</label>
            <div class="col-xs-10">
                <input type="text" class="form-control" id="abonent-adresse" name="adresse" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label" for="abonent-plz">PLZ</label>
            <div class="col-xs-10">
                <input type="text" class="form-control" id="abonent-plz" name="plz" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label" for="abonent-ort">Ort</label>
            <div class="col-xs-10">
                <input type="text" class="form-control" id="abonent-ort" name="ort" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label" for="abonent-land">Land</label>
            <div class="col-xs-10">
                <input type="text" class="form-control" id="abonent-land" name="land" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label" for="abonent-telefon">Telefon</label>
            <div class="col-xs-10">
                <input type="text" class="form-control" id="abonent-telefon" name="telefon" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label" for="abonent-email">Email</label>
            <div class="col-xs-10">
                <input type="text" class="form-control" id="abonent-email" name="email" required>
            </div>
        </div>

        <div class="form-group">
            <label for="rechnungsadresse">Abweichende Rechnungsadresse</label>
            <textarea class="form-control" id="rechnungsadresse" name="rechnungsadresse" rows="3"></textarea>
        </div>
    </fieldset>
</fieldset>

<label>Rabatt für Vereinsmitglieder: CHF 11.- / EUR 10.- auf alle Abonnemente</label>
<p>AVIA, FMA, IGFZ, Probelpmoos, SCFA,VFL<br>
Bitte tragen Sie den Vereinsnamen und Ihre Mitgliedsnummer im Feld Bemerkungen ein.</p>

</div> <!-- .row -->


<div class="row">


<div class="form-group">
    <label for="rechnungsadresse">Bemerkungen</label>
    <textarea class="form-control" id="bemerkungen" name="bemerkungen" rows="3"></textarea>
</div>

</div> <!-- .row -->
<div class="row">


<fieldset class="form-group">
    <div class="form-group row">
        <label class="col-xs-2 col-form-label" for="captcha">Captcha</label>
        <div class="col-xs-2">
            <span id="captcha-original"><?= $captcha ?></span>
            <input type="text" class="form-control" id="captcha" name="captcha" pattern="^<?= $captcha ?>$" required>
        </div>
    </div>
</fieldset>

<p>Im Anschluss an den Bestellvorgang erhalten Sie von uns eine Bestätigung per E-Mail. Die Rechnung für das Abonnement wird Ihnen per Post zugestellt.</p>

<button type="submit" class="btn btn-primary">Bestellen</button>

</div> <!-- .row -->

</form>

EOT;

$template = new Template_simple_engine();
$template->setTemplateString($htmlContent);
$htmlContent = $template->render([
    'aboStart' => $monat[$aboStart->format('n') - 1].' '.$aboStart->format('Y'),
    'aboEnd' => $monat[$aboEnd->format('n') - 1].' '.$aboEnd->format('Y'),
    'captcha' => $captcha,
]);

$template = new Template_simple_engine();
$template->setTemplateString($htmlLayout);
echo($template->render([
    'content' => $htmlContent
]));

class Template_simple_engine {

    private $templateString = null;
    private $templateFile = null;
	private $context = array();

    public function __construct($templateFilePath = null)
    {
		if (isset($templateFilePath)) {
			$this->setTemplate($templateFilePath);
		}
    }

    public function render($context = null)
    {
		if (isset($context)) {
			$this->setContext($context);
		}
        if (is_null($this->templateString) && is_null($this->templateFile)) {
            throw new InvalidArgumentException("The template is not set", 1);
		}
        $out = '';
        ob_start();
		foreach ($this->context as $key => $value) {
			${$key} = $value;
		}
        if (isset($this->templateString)) {
            eval('?>' . $this->templateString . '<?php '); $dummy = '?>';
        } else {
            include($this->templateFile);
        }
		$result .= ob_get_contents();
		ob_end_clean();

        return $result;
    }
    public function getTemplate()
    {
        return $this->templateFile;
    }
    public function setTemplate($templateFilePath)
    {
        if (!is_string($templateFilePath) || !file_exists($templateFilePath)) {
            throw new InvalidArgumentException("Template $templateFilePath doesn't exist.", 1);

        }
        $this->templateFile = $templateFilePath;
    }
    public function setTemplateString($string)
    {
        $this->templateString = $string;
    }
	public function setContext($context) {
        if (!$this->isAssoc($context)) {
            throw new InvalidArgumentException("Context must be either null or an associative array", 1);

        }
		$this->context = $context;
	}
    protected function isAssoc($array)
    {
        foreach (array_keys($array) as $k => $v) {
            if ($k !== $v) {
                return true;
            }
        }
        return false;
    }
}
