<?php
// main.php
require 'database.php';

$id = 0;
$number_of_candles = 200;

$candles = [];

while ($id <= $number_of_candles) {
    $candle = readBtcCandle($id, $pdo);
    if ($candle) {
        $candles[] = $candle;
    }
    $id++;
} 
?>
<!DOCTYPE html>
<html>
<head>
    <script src="index.js"></script>
    <title>BTC candles</title>
</head>
<body>
    <h1>BTC candles</h1>
    <table border="1">
        <tr>
            <th>Start Time</th>
            <th>Open Price</th>
            <th>High Price</th>
            <th>Low Price</th>
            <th>Close Price</th>
        </tr>
        <?php foreach ($candles as $candle) { ?>
        <tr>
            <td><?php echo $candle['startTime']; ?></td>
            <td><?php echo $candle['openPrice']; ?></td>
            <td><?php echo $candle['highPrice']; ?></td>
            <td><?php echo $candle['lowPrice']; ?></td>
            <td><?php echo $candle['closePrice']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>