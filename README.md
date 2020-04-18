# SSYTEM \ LOADER
load the right PHP files from URL


```php
// BOTH variant are possile ↓
$ufile = new \SSystem\UserFile("aaa/bbb/file@1@2.html");
$ufile = new \SSystem\UserFile( new \UrlParser\Url("aaa/bbb/file@1@2.html") );

// These ↓ are in parent/parent class \FileManager\FF
public $url  => \UrlParser\Url::getString() => "aaa/bbb/file.html"
public $size => 80
public $name => "file.html"
public $mode => 0777
public $dir  => \UrlParser\Url::getString() => "aaa/bbb"

// These ↓ are in parent class \FileManager\File
public $filename	=> "file@1@2"
public $extension	=> "html"
public $mime		=> "text/html"

// These ↓ are specific for UserFile
public $fakeUrl		=> \UrlParser\Url::getString() => "aaa/bbb/file.html"
public $fakeName	=> "file.html"
public $fakeFilename	=> "file"
public $users		=> ["1", "2"]

```
