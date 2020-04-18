# SSYTEM \ USER FOLDER
- class File extends [**\FileManager\Folder**](https://github.com/Zerig/folder-manager/blob/master/FOLDER.md)
- needs [**\UrlParser\Url**](https://github.com/Zerig/url-parser) class
- needs [**\FileManager\Folder**](https://github.com/Zerig/folder-manager) class
works with Files and give them user information


```php
// BOTH variant are possile ↓
$ufolder = new \SSystem\UserFile("aaa/bbb/folder@1@2");
$ufolder = new \SSystem\UserFile( new \UrlParser\Url("aaa/bbb/folder@1@2") );

// These ↓ are in parent/parent class \FileManager\FF
public $url  => \UrlParser\Url::getString() => "aaa/bbb/folder"
public $size => 80
public $name => "folder"
public $mode => 0777
public $dir  => \UrlParser\Url::getString() => "aaa/bbb"


// These ↓ are specific for UserFile
public $fakeUrl		=> \UrlParser\Url::getString() => "aaa/bbb/folder"
public $fakeName	=> "folder"
public $users		=> ["1", "2"]

```

## HOW USER FILE/FOLDERS WORKS
```php
// 2 types of users has access
$ufolder = new \SSystem\UserFile("aaa/bbb/folder@1@2");
$ufolder->users =>	["1", "2"]
$ufolder->name =>	"folder@1@2"
$ufolder->fakeName =>	"folder"

// 2 types of users has access
$ufolder = new \SSystem\UserFile("aaa/bbb/folder@1");
$ufolder->users => 	["1"]
$ufolder->name => 	"folder@1"
$ufolder->fakeName =>	"folder"

// all login users has access
$ufolder = new \SSystem\UserFile("aaa/bbb/folder@");
$ufolder->users => 	[""]
$ufolder->name => 	"folder@"
$ufolder->fakeName =>	"folder"

// all non login has access
$ufolder = new \SSystem\UserFile("aaa/bbb/folder");
$ufolder->users => 	null
$ufolder->name => 	"folder"
$ufolder->fakeName =>	"folder"

```

## INHERITED METHODS
[FILE MANAGER/FF::](https://github.com/Zerig/folder-manager/blob/master/FF.md)
- **exist(), isDir(), isFile()** Check if File/Folder really exist
- **rename($new_name)** Change name of folder/folder
- **move($new_dir)** Change dir, not name of folder/folder

[FILE MANAGER/FOLDER::](https://github.com/Zerig/folder-manager/blob/master/FOLDER.md)
* **copy($copy_name = null)** Copy Folder (and all Files/Folders inside) in the same dir place, but with new name.
* **scan($column = null)** Scan current folder NOT subfolders
* **scanTree($column = null)** Scan current folder and all subfolders
* **delete()** emove Folder and everything inside with all subfolders
* **clean()** Remove everything inside Folder. NOT the FOLDER


## hasUser($user_type)
- $user_type [int]
- @return [boolean]

check if user *$user_type* has acces to this folder

```php
$ufolder = new \SSystem\UserFile("aaa/bbb/folder@1@2");
$ufolder->hasUser(1)	=> true
$ufolder->hasUser([1, 2])	=> true
$ufolder->hasUser(3)	=> false

```


## getUsersCount()
- @return [int]

Return number of users, which has acces to *ufolder*

```php
$ufolder = new \SSystem\UserFile("aaa/bbb/folder");
$ufolder->getUsersCount()	=> 0

$ufolder = new \SSystem\UserFile("aaa/bbb/folder@1@2");
$ufolder->getUsersCount()	=> 2

$ufolder = new \SSystem\UserFile("aaa/bbb/folder@");
$ufolder->getUsersCount()	=> -1
```
