# SSYTEM \ USER FILE
- class File extends **\FileManager\File**
- needs **\UrlParser\Url** class
- needs **\FileManager\File** class
works with Files and give them user information


```php
// BOTH variant are possile ↓
$file = new \SSystem\UserFile("aaa/bbb/file@1@2.html");
$file = new \SSystem\UserFile( new \UrlParser\Url("aaa/bbb/file@1@2.html") );

// These ↓ are in parent/parent class FF
public $url  => \UrlParser\Url::getString() => "aaa/bbb/file.html"
public $size => 80
public $name => "file.html"
public $mode => 0777
public $dir  => \UrlParser\Url::getString() => "aaa/bbb"

// These ↓ are in parent class File
public $filename	=> "file@1@2"
public $extension	=> "html"
public $mime		=> "text/html"

// These ↓ are specific for UserFile
public $fakeUrl		=> \UrlParser\Url::getString() => "aaa/bbb/file.html"
public $fakeName	=> "file.html"
public $fakeFilename	=> "file"
public $users		=> "html"

```
