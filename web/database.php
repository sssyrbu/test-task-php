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
    $sqlFilePath = "queries/add_to_db.sql";
    $sqlQuery = file_get_contents($sqlFilePath);
    $query = $pdo->prepare($sqlQuery);
    $insert_data = [
        'startTime' => $data[0],
        'openPrice' => $data[1],
        'highPrice' => $data[2],
        'lowPrice' => $data[3],
        'closePrice' => $data[4]
    ];
    $query->execute($insert_data);
}

function readBtcCandle($id, $pdo) {
    $sqlFilePath = "queries/read_from_db.sql";
    $sqlQuery = file_get_contents($sqlFilePath);
    $query = $pdo->prepare($sqlQuery);
    $query->execute(['id' => $id]);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function deleteAllFromBtcCandle($pdo) {
    $clearTablePath= "queries/clear_table.sql";
    $clearTableQuery = file_get_contents($clearTablePath);
    $clearTableStmt = $pdo->prepare($clearTableQuery);
    $clearTableStmt->execute();
    $resetAutoincrementPath = "queries/reset_autoincrement.sql";
    $resetAutoincrementQuery = file_get_contents($resetAutoincrementPath);
    $resetAutoincrementStmt = $pdo->prepare($resetAutoincrementQuery);
    $resetAutoincrementStmt->execute();
}
?>