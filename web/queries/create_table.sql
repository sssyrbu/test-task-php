CREATE TABLE IF NOT EXISTS btc_candle (
    id INT PRIMARY KEY AUTO_INCREMENT,
    startTime BIGINT NOT NULL,        
    openPrice DECIMAL(20, 8) NOT NULL,
    highPrice DECIMAL(20, 8) NOT NULL,
    lowPrice DECIMAL(20, 8) NOT NULL,
    closePrice DECIMAL(20, 8) NOT NULL
);