<?php
/*$server="localhost";
$dbuser="root";
$dbpassword="";
$dbname="astan";
$link=mysqli_connect($server,$dbuser,$dbpassword,$dbname);
if(mysqli_connect_errno()==0)
{
    //echo"اتصال موفقیت آمیز";
}
else
{
    echo"اتصال ناموفق".mysqli_connect_erron();
    echo mysqli_connect_error();
}*/


$database_config = (object) [
    'host'    => 'localhost',
    'user'    => 'root',
    'pass'    => '',
    'dbname'  => 'astan'
];

try {
    $pdo = new PDO("mysql:host={$database_config->host};dbname={$database_config->dbname}", $database_config->user, $database_config->pass);
    $pdo->exec('set names utf8');
} catch (Exception $e) {
    die("There is something wrong with connection, error: " . $e->getMessage());
}
?>