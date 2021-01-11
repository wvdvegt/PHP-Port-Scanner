<?php
require 'class.ScanSinglePort.php';
require 'class.ScanMultiplePorts.php';

header('Content-Type: application/json');

// Example using a file to portList.txt.

// Usage: php ../repositories/portscanner/exampleCgiPortScanner.php <port number> <server url>
// Usage: php ../repositories/portscanner/exampleCgiPortScanner.php <port number[,port number, ...] <server url>

// 1) Build the PortList.txt URL.
$portlist='../repositories/portscanner/PortList.txt';

// 2) Check Port(s)& Server
$ports=explode(',',$argv[1]);
$server=$argv[2];

switch (count($ports)) {
	case 0:
		break;
	case 1:
		$PS = new ScanSinglePort($ports[0], $server, $portlist);
		//$PS->portlist=$portlist;

		print_r(json_encode($PS->scanPort()));
		break;
	default:
		$PSM = new ScanMultiplePorts($ports, $server, $portlist);
		//$PSM->portlist=$portlist;

		print_r(json_encode($PSM->scanPort()));
		break;
}