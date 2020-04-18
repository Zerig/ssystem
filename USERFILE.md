# SSYTEM \ USER FILE
- class File extends **\FileManager\File**
- needs **\UrlParser\Url** class
- needs **\FileManager\File** class
works with Files and give them user information


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


## hasUser($user_type)
- $user_type [int]
- @return [boolean]

check if user *$user_type* has acces to this file

```php
$ufile = new \SSystem\UserFile("aaa/bbb/file@1@2.html");
$ufile->hasUser(1)	=> true
$ufile->hasUser([1, 2])	=> true
$ufile->hasUser(3)	=> false

```


## getUsersCount()
- @return [int]

Return number of users, which has acces to *ufile*

```php
$ufile = new \SSystem\UserFile("aaa/bbb/file.html");
$ufile->getUsersCount()	=> 0

$ufile = new \SSystem\UserFile("aaa/bbb/file@1@2.html");
$ufile->getUsersCount()	=> 2

$ufile = new \SSystem\UserFile("aaa/bbb/file@.html");
$ufile->getUsersCount()	=> -1
```
