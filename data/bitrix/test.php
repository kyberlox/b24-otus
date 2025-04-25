<?php
// session_start();
// $_SESSION['test'] = 'Hello Docker';
// echo $_SESSION['test'];

header('Content-Type: text/plain; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== MySQL Connection Test ===\n\n";

// Параметры подключения из переменных окружения
$db_host = getenv('MYSQL_HOST') ?: 'mysql';
$db_name = getenv('MYSQL_DATABASE') ?: 'bitrix';
$db_user = getenv('MYSQL_USER') ?: 'bitrix';
$db_pass = getenv('MYSQL_PASSWORD') ?: 'bitrix_password';

echo "Connection parameters:\n";
echo "Host: $db_host\n";
echo "Database: $db_name\n";
echo "Username: $db_user\n\n";

try {
    // Подключение к MySQL
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    
    echo "Trying to connect...\n";
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
    
    echo "✅ Successfully connected to MySQL server!\n\n";
    
    // Проверка версии MySQL
    $version = $pdo->query('SELECT VERSION()')->fetchColumn();
    echo "MySQL Server version: $version\n";
    
    // Проверка списка баз данных
    echo "\nAvailable databases:\n";
    $databases = $pdo->query('SHOW DATABASES')->fetchAll(PDO::FETCH_COLUMN);
    foreach ($databases as $db) {
        echo "- $db\n";
    }
    
    // Проверка таблиц в текущей базе
    if (in_array($db_name, $databases)) {
        echo "\nTables in database '$db_name':\n";
        $tables = $pdo->query("SHOW TABLES FROM `$db_name`")->fetchAll(PDO::FETCH_COLUMN);
        foreach ($tables as $table) {
            echo "- $table\n";
        }
    } else {
        echo "\n⚠️ Database '$db_name' doesn't exist!\n";
    }
    
} catch (PDOException $e) {
    echo "\n❌ Connection failed:\n";
    echo "Error code: " . $e->getCode() . "\n";
    echo "Error message: " . $e->getMessage() . "\n";
    
    // Дополнительная диагностика
    echo "\nDiagnostic info:\n";
    echo "PHP version: " . phpversion() . "\n";
    echo "PDO MySQL available: " . (extension_loaded('pdo_mysql') ? 'yes' : 'no') . "\n";
    
    // Проверка сетевого подключения
    echo "\nTesting network connection to '$db_host:3306'...\n";
    $socket = @fsockopen($db_host, 3306, $errno, $errstr, 5);
    if ($socket) {
        echo "✅ Network connection to MySQL port is OK\n";
        fclose($socket);
    } else {
        echo "❌ Cannot reach MySQL server: $errstr ($errno)\n";
    }
}

session_start();
$_SESSION['test'] = 'Hello Docker';
echo $_SESSION['test'];
phpinfo();

// phpinfo();
?>