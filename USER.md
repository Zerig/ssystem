# SSYTEM \ USER
- needs [**\SqlManager\Mysql**](https://github.com/Zerig/sql-manager) class
works with User account


## FIRST YOU NEED
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

	INSERT INTO `user` (`id`, `user_type_id`, `login`, `password`) VALUES
	(1,	1,	'zerig',	'$2y$15$"."u55Iz2kebEpW01bMLYYcReBGy5ZHoFvmRQyeaerGp0f8GnMLrbJEq');

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

public $id              => 1
public $user_type_id    => 1
public $user_type_name  => "admin"
public $login           => "zerig"

public static $pass_len => 6;	// MIN length of passwords

```
<br>
<hr>
<br>

## login($login, $password)
- **$login [string]** user name for login
- **$paddword [string]** user password for login
* **@return [boolean]** success of action

Log user into system.

```php
$GLOBALS["user"]->login("not_exist", "123456") => 0
$GLOBALS["user"]->isLogged() => 0

$GLOBALS["user"]->login("zerig", "123456")	   => 1
$GLOBALS["user"]->isLogged() => 1
```

## logout()
* **@return [boolean]** success of action

Log user out of system.

```php
$GLOBALS["user"]->logout()   => 1
$GLOBALS["user"]->isLogged() => 0
```
