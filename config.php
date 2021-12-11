<?php 
// DB credentials.
define('DB_HOST','ls-1c31f2d025ebc54e33379b49252559964309ae0e.cwaaley7zj90.us-east-2.rds.amazonaws.com');
define('DB_USER','dbmasteruser');
define('DB_PASS','v*&Z[lBm-fA_]W.#f5[S=^uaDAJJ8c)t');
define('DB_NAME','dbmaster');
// Establish database connection.

try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>