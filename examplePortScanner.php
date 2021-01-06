<?php
require 'class.ScanSinglePort.php';
require 'class.ScanMultiplePorts.php';

header('Content-Type: application/json');

// Example using a URL to portList.txt.

// Usage: http://localhost/PHP-Port-Scanner/examplePortScanner.php?port=<port number>&server=<server url>
// Usage: http://localhost/PHP-Port-Scanner/examplePortScanner.php?port=<port number[,port number, ...]>&server=<server url>

// 1) Get URL of this page.
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// 2) Parse URL into parts.
$parts=parse_url($url);

// 3) Build the PortList.txt URL.
$portlist=$parts['scheme'].'://'.$parts['host'].str_replace('examplePortScanner.php','',$parts['path']).'PortList.txt';

// 4) Parse query part
parse_str($parts['query'], $queryparts);

// 5) Check Port(s)
$ports=explode(',',$queryparts['port']);
switch (count($ports)) {
	case 0:
		break;
	case 1:
		$PS = new ScanSinglePort($ports[0],$queryparts['server'], $portlist);
		print_r(json_encode($PS->scanPort()));
		break;
	default:
		$PSM = new ScanMultiplePorts($ports,$queryparts['server'], $portlist);
		print_r(json_encode($PSM->scanPort()));
		break;
}