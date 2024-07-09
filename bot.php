<?php
// bot.php
require 'vendor/autoload.php';
include 'database.php';

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\Polling;

$bot = new Nutgram('6840307916:AAGT4RnFLtF0S-t-_weyAdx14koxU_DQZ3g');
$bot->setRunningMode(Polling::class);

$bot->onCommand('start', function(Nutgram $bot) {
    $bot->sendMessage('Привет');
});

$bot->onCommand('kurs', function(Nutgram $bot) use ($pdo) {
    $id = 200;
    $currentPriceArray = readBtcCandle($id, $pdo);
    $bot->sendMessage('Курс BTC: ' . $currentPriceArray['closePrice'] . "$");
});

$bot->onMessage(function(Nutgram $bot) {
    $bot->sendMessage("Вы сказали: " . $bot->message()->text);
});

$bot->run();
?>