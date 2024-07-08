<?php
// bybit.php
include "database.php";
$url = "https://api-testnet.bybit.com/v5/market/kline?category=inverse&symbol=BTCUSD&interval=D";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
    echo "cURL error: $error_msg";
} else {
    $data = json_decode($response, true);
    $candles = $data['result']['list'];
    foreach ($candles as $candle) { 
        insertBtcCandle($candle, $pdo);
    }
}

curl_close($curl);
?>