<code style="white-space: pre;">
<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload files using Composer autoload

require_once "_sys/config.php";




echo "<b>SERVER_ROOT:</b> ".$GLOBALS["server_root"]->getString();
echo "<table><tr>";
echo "<td style='white-space: pre;color:red' valign='top'><b>URL:</b> ";
echo print_r($GLOBALS["url"]);
echo "</td>";
echo "<td style='white-space: pre;color:purple' valign='top'><b>SERVER_URL:</b> ";
echo print_r($GLOBALS["server_url"]);
echo "</td>";
echo "</tr></table>";
echo "<hr>";


//$PHP_loader = new \SSystem\Loader(clone $GLOBALS["server_url"]);
