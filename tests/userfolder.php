<code style="white-space: pre;">
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

$name = "aaa/folder";
echo "uFOLDER: ".$name."<br>";
$ufolder = new \SSystem\UserFolder($name);
echo "::url->getString() 	=> ".$ufolder->url->getString()."<br>";
echo "::fakeurl->getString()	=> ".$ufolder->fakeUrl->getString()."<br>";
echo "<br>---------------------------------------<br><br>";

$name = "aaa/folder@1";
echo "uFOLDER: ".$name."<br>";
$ufolder = new \SSystem\UserFolder($name);
echo "::url->getString() 	=> ".$ufolder->url->getString()."<br>";
echo "::fakeurl->getString() 	=> ".$ufolder->fakeUrl->getString()."<br>";
echo "<br>---------------------------------------<br><br>";

$name = "aaa/folder@1@2@3";
echo "uFOLDER: ".$name."<br>";
$ufolder = new \SSystem\UserFolder($name);
echo "::url->getString() 	=> ".$ufolder->url->getString()."<br>";
echo "::fakeurl->getString() 	=> ".$ufolder->fakeUrl->getString()."<br>";
echo "::ufile->users: ";
echo print_r($ufolder->users)."<br>";
echo "<br>---------------------------------------<br><br>";
echo "<br>---------------------------------------<br><br>";

$name = "aaa/folder@1@2@3";
echo "uFOLDER: ".$name."<br>";
$ufolder = new \SSystem\UserFolder($name);
echo "::hasUser(1) =>		".$ufolder->hasUser(1)."<br>";
echo "::hasUser([1,2]) =>	".$ufolder->hasUser([1,2])."<br>";
echo "::hasUser(4) =>		".$ufolder->hasUser(4)."<br>";
echo "::hasUser([1,2,4]) =>	".$ufolder->hasUser([1,2,4])."<br>";


echo "<br>---------------------------------------<br><br>";

$name = "aaa/folder@1@2@3";
echo "uFOLDER: ".$name."<br>";
$ufolder = new \SSystem\UserFolder($name);
echo "::getUsersCount() =>  ".$ufolder->getUsersCount()."<br>";
echo "<br>";
$name = "aaa/folder@1";
echo "uFOLDER: ".$name."<br>";
$ufolder = new \SSystem\UserFolder($name);
echo "::getUsersCount() =>  ".$ufolder->getUsersCount()."<br>";
echo "<br>";
$name = "aaa/folder@";
echo "uFOLDER: ".$name."<br>";
$ufolder = new \SSystem\UserFolder($name);
echo "::getUsersCount() => ".$ufolder->getUsersCount()."<br>";
echo "<br>";
$name = "aaa/folder";
echo "uFOLDER: ".$name."<br>";
$ufolder = new \SSystem\UserFolder($name);
echo "::getUsersCount() =>  ".$ufolder->getUsersCount()."<br>";



echo "<br>---------------------------------------<br><br>";
