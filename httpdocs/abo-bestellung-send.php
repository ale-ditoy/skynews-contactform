<?php
// $mailTo = ['rimoldi@ditoy.com'];
$mailTo = ['hjburgi@gmail.com', 'skynews@avd.ch'];

$catchaFile = 'captcha-archive.txt';
if (file_exists($catchaFile)) {
    $captchaArchive = json_decode(file_get_contents('captcha-archive.txt'));
} else {
    $captchaArchive = [];
}

$values = [];
foreach (['captcha', 'abo', 'name', 'vorname', 'adresse', 'plz', 'ort', 'land', 'telefon', 'email', 'rechnungsadresse', 'bemerkungen'] as $item) {
    $values[$item] = array_key_exists($item, $_REQUEST) ? $_REQUEST[$item] : null;
}

if (
    ($values['captcha'] && in_array($values['captcha'], $captchaArchive)) ||
    ($values['name'] || $values['vorname']) &&
    (($values['adresse'] && $values['ort']) || $values['email'])
) {
    $emailBody = [];
    foreach (['Abo', 'Name', 'Vorname', 'Adresse', 'PLZ', 'Ort', 'Land', 'Telefon', 'Email', 'Rechnungsadresse', 'Bemerkungen'] as $item) {
        $key = strtolower($item);
        if ($values[$key]) {
            $emailBody[] = strtr($item, '-', ' ').": ".$values[$key];
        }
    }
    $emailBody = implode("\n", $emailBody);
    echo("<pre>".$emailBody."</pre>");

    $to      = implode(', ', $mailTo);
    $subject = 'Abo-Formular: '.implode(" ", array_filter([$values['Vorname'], $values['Name']]));
    $message = $emailBody;
    $headers = 'From: '. reset($mailTo) . "\r\n" .
        'Reply-To: ' .reset($mailTo). "\r\n" .
        'Content-Type: text/plain; charset="utf-8"'. "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    if ($values['email']) {
        $bodyClient = "
Herzlich willkommen an Bord von SkyNews.ch!

Wir danken Ihnen für Ihre Abo-Bestellung. In den nächsten Tagen werden Sie die aktuellen Ausgaben als Begrüssungsgeschenk erhalten.

Für Fragen stehen wir Ihnen gerne unter der Telefonnummer 044 881 72 61 zur Verfügung.

Wir wünschen Ihnen nun eine interessante Lektüre mit SkyNews.ch

Hansjörg Bürgi, Chefredaktor und Verleger

        \n";
        $subject = 'SkyNews.ch Abo';
        $message = $bodyClient.$emailBody;
        $headers = 'From: '. reset($mailTo) . "\r\n" .
            'Reply-To: ' .reset($mailTo). "\r\n" .
            'Content-Type: text/plain; charset="utf-8"'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($values['email'], $subject, $message, $headers);
    }
}

header("Location: ". $_SERVER['REQUEST_SCHEME'].'://'. $_SERVER['HTTP_HOST']  ); // go to the homepage
die();
