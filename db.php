<?php
// mostra uma mensagem de erro vinda do mysql
function showerror()
{
	die("Error " . mysql_errno() . " : " . mysql_error());
}

//ONLINE
//$hostname = "10.10.23.183";
//$db_name = "db_a57580";
//$db_user = "a999990";
//$db_passwd = "GN848SS";

//LOCALHOST
$hostname = "localhost";
$db_name = "DAW18_19DB";
$db_user = "root";
$db_passwd = "";

// faz uma conexão a uma base de dados
function dbconnect($hostname, $db_name,$db_user,$db_passwd)
{
	$db = @ mysql_connect($hostname, $db_user,$db_passwd);
	
	mysql_set_charset('utf8', $db); // <-- mycode
	
	if(!$db) {
		die("Nao consigo ligar ao servidor da base de dados.");
	}
	if(!(@ mysql_select_db($db_name,$db))){
		showerror();
	}
	return $db;
}
?>