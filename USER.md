# SSYTEM \ USER
- needs [**\SqlManager\Mysql**](https://github.com/Zerig/sql-manager) class
works with User account

```php
$GLOBALS["mysql"] = new \SqlManager\Mysql([
	"server_name"	=> "localhost",
	"db_user"	=> "root",
	"db_pass"	=> "",
	"db_name"	=> "test"
]);

$GLOBALS["mysql"]->multi_query("
	CREATE TABLE `user` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `user_type_id` smallint(2) DEFAULT NULL,
	  `login` varchar(150) COLLATE utf8_czech_ci NOT NULL,
	  `password` varchar(150) COLLATE utf8_czech_ci NOT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `login` (`login`),
	  KEY `user_type_id` (`user_type_id`),
	  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

	CREATE TABLE `user_type` (
	  `id` smallint(2) NOT NULL AUTO_INCREMENT,
	  `name` varchar(150) COLLATE utf8_czech_ci NOT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `name` (`name`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

	INSERT INTO `user_type` (`id`, `name`) VALUES
	(2,	'editor'),
	(1,	'admin');
");
```
```php
$GLOBALS["user"] = new \SSystem\User();
$GLOBALS["user"]->login("zerig", "123456");

public $id             =>
public $user_type_id   =>
public $user_type_name =>
public $login          =>

public static $pass_len = 6;



```
