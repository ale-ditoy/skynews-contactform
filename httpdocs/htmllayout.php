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


