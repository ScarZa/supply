<?php
require '../class/conn_db.php';
$myconfig = new Conn_DB();
$myconfig->read="../connection/conn_DB.txt";
$conf=$myconfig->config();
        $dbhost=$conf["hostname"];
        $dbuser=$conf["username"];
        $dbpass=$conf["password"];
        $dbname=$conf["database"];
        $dbport=$conf["port"];
        
$dbh = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$dbname.';charset=utf8',''.$dbuser.'',''.$dbpass.'');


                
/*require 'class/conn_db.php';
$my_conn = new Conn_DB();
$my_conn->read="../connection/conn_DB.txt";
$db=$my_conn->conn_mysqli();
$dbh=$my_conn->conn_POD();
$reader=$my_conn->config();
print_r($reader);*/
?>
