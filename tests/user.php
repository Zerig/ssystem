<code style="white-space: pre;">
<div style="display:flex;justify-content:space-around">
<div>
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
echo "<h2>USER</h2>";
echo "<hr>";

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

$GLOBALS["user"] = new \SSystem\User();

echo '<b>$GLOBALS["user"]->login("zerig", "ni2grrxu")</b>'."\n";
if($GLOBALS["user"]->login("zerig", "ni2grrxu")){
	echo '$GLOBALS["user"]->id             => '.$GLOBALS["user"]->id."\n";
	echo '$GLOBALS["user"]->user_type_id   => '.$GLOBALS["user"]->user_type_id."\n";
	echo '$GLOBALS["user"]->user_type_name => '.$GLOBALS["user"]->user_type_name."\n";
	echo '$GLOBALS["user"]->login          => '.$GLOBALS["user"]->login."\n";

}
echo "\n";
echo '<b>$GLOBALS["user"]->isLogged()</b> => '.$GLOBALS["user"]->isLogged()."\n";

echo "<br>---------------------------------------<br><br>";

echo '<b>$GLOBALS["user"]->logout()</b>'.$GLOBALS["user"]->logout()."\n";
echo '$GLOBALS["user"]->isLogged() => '.$GLOBALS["user"]->isLogged()."\n";

echo "<br>---------------------------------------<br><br>";

echo '<b>\SSystem\User::signup("nym", "123456", 1)</b> => '.\SSystem\User::signup("nym", "123456", 1)."\n";
echo '$GLOBALS["user"]->login("nym", "123456")  => '.$GLOBALS["user"]->login("nym", "123456")."\n";
echo '$GLOBALS["user"]->isLogged() => '.$GLOBALS["user"]->isLogged()."\n";

echo "<br>---------------------------------------<br><br>";

echo '<b>\SSystem\User::existUser("not_exist")</b> => '.\SSystem\User::existUser("not_exist")."\n";
echo '<b>\SSystem\User::existUser("nym")</b>       => '.\SSystem\User::existUser("nym")."\n";

echo "<br>---------------------------------------<br><br>";

echo '<b>$GLOBALS["user"]->changePassword("123456", "666")</b>              => '.$GLOBALS["user"]->changePassword("123456", "666")."\n";
echo '<b>$GLOBALS["user"]->changePassword("123456", "666666")</b>           => '.$GLOBALS["user"]->changePassword("123456", "666666")."\n";
echo '<b>$GLOBALS["user"]->changePassword("666666", "123", "123")</b>       => '.$GLOBALS["user"]->changePassword("666666", "123", "123")."\n";
echo '<b>$GLOBALS["user"]->changePassword("666666", "123456", "123333")</b> => '.$GLOBALS["user"]->changePassword("666666", "123456", "123333")."\n";

echo "<br>---------------------------------------<br><br>";

echo '<b>$GLOBALS["user"]->changeLogin("nym2", "666666")</b> => '.$GLOBALS["user"]->changeLogin("nym2", "666666")."\n";

echo "<br>---------------------------------------<br><br>";

echo '<b>\SSystem\User::removeUser("not_exist")</b> => '.\SSystem\User::removeUser("not_exist")."\n";
echo '<b>\SSystem\User::removeUser("nym")</b>       => '.\SSystem\User::removeUser("nym")."\n";
echo "\n";
echo '\SSystem\User::existUser("not_exist")  => '.\SSystem\User::existUser("not_exist")."\n";
echo '\SSystem\User::existUser("nym")        => '.\SSystem\User::existUser("nym")."\n";







?>
</div>










<div>
<?php
echo "<h2>MYSQL LOG</h2>";
echo "<hr>";
foreach(\Console\Log::getMysql() as $log_data){
	//echo $log_data->file.' on line '.$log_data->line."\n";
	echo $log_data->sql."\n";
	echo "<br>---------------------------------------<br><br>";
}


?>
</div>









<div>
<?php


?>
</div>








</div>
