<?php

$db_host	 = "127.0.0.1";
$db_user	 = "root";
$db_password = "";
$db_name 	 = "donation";

try {
	$c = new PDO('mysql:host='.$db_host.';dbname='.$db_name,$db_user,$db_password);
	$c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$c->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
	$c->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>