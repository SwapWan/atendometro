<?php
$host = "smartwan.mysql.database.azure.com";
$dbname = "checkout";
$username = "smartwan";
$password = "Qwe_)(99";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Falha na Conexão: " . $e->getMessage();
    }
?>