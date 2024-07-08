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

$candles = array_reverse($candles);
$data = [];

foreach ($candles as $candle) {
    $data[] = [
        'open' => floatval($candle['openPrice']),
        'high' => floatval($candle['highPrice']),
        'low' => floatval($candle['lowPrice']),
        'close' => floatval($candle['closePrice']),
        'time' => intval($candle['startTime'] / 1000) // Convert milliseconds to seconds
    ];
}
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
    <title>BTC candles</title>
</head>
<body>
    <h1>BTC candles</h1>
    <div id="container" style="width: 100%; height: 800px;"></div>
    <script type="module">
        document.addEventListener('DOMContentLoaded', () => {
            console.log("loaded dom");
            const { createChart } = LightweightCharts;

            const chartOptions = { layout: { textColor: 'white', background: { type: 'solid', color: 'black' } } };

            const chart = createChart(document.getElementById('container'), chartOptions);
            const candlestickSeries = chart.addCandlestickSeries({ upColor: '#26a69a', downColor: '#ef5350', borderVisible: false, wickUpColor: '#26a69a', wickDownColor: '#ef5350' });

            const data = <?php echo json_encode($data); ?>;

            candlestickSeries.setData(data);
            chart.timeScale().fitContent();
        });
    </script>
</body>
</html>