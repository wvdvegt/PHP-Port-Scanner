<?php
require 'class.ScanSinglePort.php';
$PS = new ScanSinglePort(587,'http://www.w3bspark.com');
echo "<pre>";
print_r($PS->scanPort());