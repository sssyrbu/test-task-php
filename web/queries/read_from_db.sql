SELECT startTime, openPrice, highPrice, lowPrice, closePrice
FROM btc_candle
WHERE id = :id;