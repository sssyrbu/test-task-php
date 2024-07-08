<?php
// database.php
$config = include "config.php";

$db_host = $config['db_host'];
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_name = $config['db_name'];

$dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$sqlFilePath = "queries/create_table.sql";

$sql = file_get_contents($sqlFilePath);

$pdo->exec($sql);

function insertBtcCandle($data, $pdo) {
    try {
        $sqlFilePath = "queries/add_to_db.sql";
        $sqlQuery = file_get_contents($sqlFilePath);
        $query = $pdo->prepare($sqlQuery);
        $query->execute($data);

        return "Data inserted successfully!";
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

// Example usage
$data = [
    'startTime' => 1720396800000,
    'openPrice' => 55825.00000000,
    'highPrice' => 57858.50000000,
    'lowPrice' => 54269.50000000,
    'closePrice' => 57417.50000000
];

echo insertBtcCandle($data, $pdo);
?>