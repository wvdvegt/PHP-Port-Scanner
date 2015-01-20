<?php
require 'class.ScanMultiplePorts.php';
$PS = new ScanMultiplePorts(array(110,443,80),'yahoo.com');
echo "<pre>";
print_r($PS->scanPort());