<?php
/*$host = "127.0.0.1";
$user_db = "root";
$pw_db = "";
$db_name = "as_proj_esp8266";

$con = new mysqli($host, $user_db, $pw_db, $db_name);
if($conn->connect_errno)
    die("Connessione fallita: " . $conn->connect_errno);
*/
$config = [
    'db_engine' => 'mysql',
    'db_host' => '127.0.0.1',
    'db_name' => 'my_cmsandrew',
    'db_user' => 'cmsandrew',
    'db_password' => 'p9PHf4ra28D2',
];

$db_config = $config['db_engine'] . ":host=".$config['db_host'] . ";dbname=" . $config['db_name'];

try {
    $pdo = new PDO($db_config, $config['db_user'], $config['db_password'], [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    exit("Impossibile connettersi al database: " . $e->getMessage());
}

//header("Location: ../index.php");
?>
