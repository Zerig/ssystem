# SSYTEM \ URL
- class File extends [**\UrlParser\Url**](https://github.com/Zerig/url-parser)
- needs [**\UrlParser\Url**](https://github.com/Zerig/url-parser) class
- needs [**\FileManager\File**](https://github.com/Zerig/file-manager) class

works with URL and set "split" PATH into 3 parts:
- **DIR** Real dir folder which takes PHP files
- **MYSQL** Mysql part - which loads data from MySQL
- **GET** Part in *URL PATH* which is used like GET

```code
http://server.com/
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
public $dir		
public $mysql
public $get		//

```
