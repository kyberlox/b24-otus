test.php
<?php
// Должно быть самым первым в файле, без пробелов/переносов перед <?php
ob_start();
header('Content-Type: text/plain; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== MySQL Connection Test ===\n\n";

$db_host = 'mysql';
$db_name = 'bitrix';
$db_user = 'kyberlox';
$db_pass = '4179'; // Замените на реальный пароль

try {
    $dsn = "mysql:host=$db_host;charset=utf8";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    
    echo "Trying to connect...\n";
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
    
    // Проверка существования базы
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✅ Database '$db_name' created/exists\n";
    
    // Подключение к конкретной базе
    $pdo->exec("USE `$db_name`");
    echo "✅ Successfully connected to MySQL server!\n";
    
} catch (PDOException $e) {
    echo "\n❌ Connection failed:\n";
    echo "Error code: " . $e->getCode() . "\n";
    echo "Error message: " . $e->getMessage() . "\n";
    
    echo "\nDiagnostic info:\n";
    echo "PHP version: " . phpversion() . "\n";
    echo "PDO MySQL available: " . (extension_loaded('pdo_mysql') ? 'yes' : 'no') . "\n";
    
    // Проверка сетевого подключения
    $socket = @fsockopen($db_host, 3306, $errno, $errstr, 2);
    if ($socket) {
        echo "✅ Network connection to MySQL port is OK\n";
        fclose($socket);
    } else {
        echo "❌ Cannot reach MySQL server: $errstr ($errno)\n";
    }
}
ob_end_flush();
