<code style="white-space: pre;">
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

$name = "aaa/index.php";
echo "uFILE: ".$name."<br>";
$ufile = new \SSystem\UserFile($name);
echo "::url->getString() 	=> ".$ufile->url->getString()."<br>";
echo "::fakeurl->getString()	=> ".$ufile->fakeUrl->getString()."<br>";
echo "<br>---------------------------------------<br><br>";

$name = "aaa/@1.php";
echo "uFILE: ".$name."<br>";
$ufile = new \SSystem\UserFile($name);
echo "::url->getString() 	=> ".$ufile->url->getString()."<br>";
echo "::fakeurl->getString() 	=> ".$ufile->fakeUrl->getString()."<br>";
echo "<br>---------------------------------------<br><br>";

$name = "aaa/index@1@2@3.php";
echo "uFILE: ".$name."<br>";
$ufile = new \SSystem\UserFile($name);
echo "::url->getString() 	=> ".$ufile->url->getString()."<br>";
echo "::fakeurl->getString() 	=> ".$ufile->fakeUrl->getString()."<br>";
echo "::ufile->users: ";
echo print_r($ufile->users)."<br>";
echo "<br>---------------------------------------<br><br>";
echo "<br>---------------------------------------<br><br>";

$name = "aaa/index@1@2@3.php";
echo "uFILE: ".$name."<br>";
$ufile = new \SSystem\UserFile($name);
echo "::hasUser(1) =>		".$ufile->hasUser(1)."<br>";
echo "::hasUser([1,2]) =>	".$ufile->hasUser([1,2])."<br>";
echo "::hasUser(4) =>		".$ufile->hasUser(4)."<br>";
echo "::hasUser([1,2,4]) =>	".$ufile->hasUser([1,2,4])."<br>";


echo "<br>---------------------------------------<br><br>";

$name = "aaa/index@1@2@3.php";
echo "uFILE: ".$name."<br>";
$ufile = new \SSystem\UserFile($name);
echo "::getUsersCount() =>  ".$ufile->getUsersCount()."<br>";
echo "<br>";
$name = "aaa/index@1.php";
echo "uFILE: ".$name."<br>";
$ufile = new \SSystem\UserFile($name);
echo "::getUsersCount() =>  ".$ufile->getUsersCount()."<br>";
echo "<br>";
$name = "aaa/index@.php";
echo "uFILE: ".$name."<br>";
$ufile = new \SSystem\UserFile($name);
echo "::getUsersCount() => ".$ufile->getUsersCount()."<br>";
echo "<br>";
$name = "aaa/index.php";
echo "uFILE: ".$name."<br>";
$ufile = new \SSystem\UserFile($name);
echo "::getUsersCount() =>  ".$ufile->getUsersCount()."<br>";



echo "<br>---------------------------------------<br><br>";
