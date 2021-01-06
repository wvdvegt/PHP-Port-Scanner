<?php
require_once 'class.PortScanner.php';

class ScanSinglePort extends PortScanner {

    function __construct($portNumber,$hostName,$portlist='PortList.txt') {
        if(is_array($portNumber)) {
            die('Only single port is allowed to scan');
        }
        parent::__construct($portNumber,$hostName,$portlist);
    }

    public function scanPort() {
        if ($this->checkStatus()) {
            $this->scanResult = array(
                'Port Number' => $this->portNumber,
                'Port Name' => $this->getPortName(),
                'Host Name' => $this->hostName,
                'Scan Result' => 'Port Open',
            );
        } else {
            $this->scanResult = array(
                'Port Number' => $this->portNumber,
                'Port Name' => $this->getPortName(),
                'Host Name' => $this->hostName,
                'Scan Result' => 'Port Closed',
            );
        }
        return $this->scanResult;
    }
}