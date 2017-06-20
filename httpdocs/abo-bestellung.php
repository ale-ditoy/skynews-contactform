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
<html lang="de-CH">
 <head>
  <meta charset=utf-8>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.2.1.352"/>
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
    }
    
    #captcha-original {
        font-size:21pt;
    }


    .skynews-header {
      text-align:center;
      padding-top:25px;
      padding-bottom:25px;
    }

    .skynews-navigation {
      min-height:58px;
      background-color:#212121;
    }

    .skynews-content {
      padding-top:25px;
    }

    .skynews-footer {
      min-height: 136px;
      margin-top: 44px;
      background-color:#212121;
    }
    .skynews-footer p {
      padding-top:46px;
      padding-left:120px;
      font-family: montserrat, sans-serif;
      font-size: 12px;
      font-weight: 400;
      line-height: 1.5;
      color:white;
    }

    .skynews-footer p a {
      color:#19D4DB;
    }

   </style>
   </head>
 <body>
  <div class="container">
    <div class="row skynews-header">
      <div class="col">
      <a href="/"><img src="skynews.jpg"></a>
      </div>
    </div>

    <div class="row">
      <div class="col skynews-navigation">
      </div>
    </div>

    <div class="row skynews-content">
      <?= $content ?>
    </div>

    <div class="row skynews-footer">
      <p>Aviation Media AG<br>
      Oberteufenerstrasse 58<br>
      8428 Teufen-Zürich<br>
      T 044 881 72 61<br>
      M <a href="mailto:info@skynews.ch">info@skynews.ch</a></p>
    </div>
  <div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
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

<form method="post" action="/">
  <p><button type="submit" class="btn btn-secondary">Zurück</button></p>
</form>

<form method="post" action="abo-bestellung-send.php" id="abonieren" data-toggle="validator">

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
