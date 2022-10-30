<?php
$dir = __DIR__ . "/../lib/feather";
$files = array_diff(scandir($dir), array('.', '..', "*:Zone.Identifier"));
foreach ($files as $file) {
    $file = str_replace(".svg", "", $file);
    echo ("$file : $file" . PHP_EOL);

}