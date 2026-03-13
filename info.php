<?php
$host = 'localhost';
$port = '3306';  // 指定端口号
$dbname = 'bingo_wms';
$username = 'root';
$password = '123456';
$charset = 'utf8mb4';

try {
    // 在host后面直接加上端口号
    $dsn = sprintf("mysql:host=%s;port=%s;dbname=%s;charset=%s",
        $host, $port, $dbname, $charset);

    $pdo = new PDO($dsn, $username, $password);

    // 设置错误模式为异常
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "连接成功！";

} catch(PDOException $e) {
    echo "连接失败: " . $e->getMessage();
}
?>