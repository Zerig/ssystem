# SSYTEM \ USER
- needs [**\SqlManager\Mysql**](https://github.com/Zerig/sql-manager) class
works with User account


```php
$GLOBALS["user"] = new \SSystem\User();
$GLOBALS["user"]->login("zerig", "123456");

public $id;
public $user_type_id;
public $user_type_name;
public $login;

public static $pass_len = 6;



```
