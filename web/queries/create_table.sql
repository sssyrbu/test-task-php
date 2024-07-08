CREATE TABLE IF NOT EXISTS btc_candle (
    startTime BIGINT,        
    openPrice DECIMAL(20, 8),
    highPrice DECIMAL(20, 8),
    lowPrice DECIMAL(20, 8),
    closePrice DECIMAL(20, 8)
)