# SSYTEM \ URL
- class File extends [**\UrlParser\Url**](https://github.com/Zerig/url-parser)
- needs [**\UrlParser\Url**](https://github.com/Zerig/url-parser) class
- needs [**\FileManager\File**](https://github.com/Zerig/file-manager) class

works with URL and set "split" PATH into 3 parts:
- **DIR** Real dir folder which takes PHP files
- **MYSQL** Mysql part - which loads data from MySQL
- **GET** Part in *URL PATH* which is used like GET

```code
http://www.web.cz/root/
 ├── _sys/			← system folder => settings
 │   └── config.php		← initial config runner
 ├── www/			← web app folder
 │   ├── aaa/			← example of folder
 │   │   ├── bbb/
 │   │   └── .php
 │   └── index.php
 ├── .htaccess			← router .htaccess settings
 └── index.php			← main file which call everything
```
```php
// INITIAL CONFIG URL SETTINGS ↓
$http = ( isset($_SERVER["HTTPS"]) ? 'https://' : 'http://' );	// Just get which type the URL is

$GLOBALS["server_root"] = new \UrlParser\Url($http.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);		// set root folder as ROOT
$GLOBALS["server_root"]->pop();	// remove "index.php" part

$GLOBALS["server_url"] =  new \UrlParser\Url($http.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
$GLOBALS["url"] =	  new \SSystem\Url($http.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], clone $GLOBALS["server_url"]);
// -----------------------------
```
## FOR EXAMPLE we can have this:
```php
$GLOBALS["url"]->getString() => "http://www.web.cz/root/aaa/bbb/ccc.html?member=me&age=15#hashtag"

public $scheme 	 => "http"
public $host 	 => "www.web.cz"
public $root 	 => "root"
public $path 	 => "aaa/bbb/ccc.html"
public $query 	 => "?member=me&age=15"
public $fragment => "hashtag"


public $dir	 => "www/aaa/bbb"
public $mysql	 => ""
public $get	 => "ccc"
```
