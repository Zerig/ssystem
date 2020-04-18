<?php

// MYSQL
$GLOBALS["mysql"] = new \SqlManager\Mysql([
	"server_name"	=> "sql.server.cz",
	"db_user"	=> "server_user",
	"db_pass"	=> "123456",
	"db_name"	=> "my_server_db"
],[
	"server_name"	=> "localhost",
	"db_user"	=> "root",
	"db_pass"	=> "",
	"db_name"	=> "_ssystem"
]);


// URL
$http = ( isset($_SERVER["HTTPS"]) ? 'https://' : 'http://' );
$GLOBALS["server_root"] =	new \UrlParser\Url($http.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);		// set root folder as ROOT
$GLOBALS["server_root"]->pop();
$GLOBALS["server_url"] = 	new \UrlParser\Url($http.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);

$GLOBALS["url"] = 			new \SSystem\Url($http.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], clone $GLOBALS["server_url"]);
