<code style="white-space: pre;">
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload


$ufile = new \SSystem\UserFile("aaa/index.php");
echo $ufile->url->getString()."<br>";
echo $ufile->fakeUrl->getString()."<br>";
echo "<br>---------------------------------------<br><br>";

$ufile = new \SSystem\UserFile("aaa/@1.php");
echo $ufile->url->getString()."<br>";
echo $ufile->fakeUrl->getString()."<br>";
echo "<br>---------------------------------------<br><br>";


$ufile = new \SSystem\UserFile("aaa/index@1@2@3.php");
echo $ufile->url->getString()."<br>";
echo $ufile->fakeUrl->getString()."<br>";
echo print_r($ufile->users)."<br>";
echo "<br>---------------------------------------<br><br>";
