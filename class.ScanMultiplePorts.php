<?php
require_once 'class.PortScanner.php';

class ScanMultiplePorts extends PortScanner
{
    protected $allPorts;

    function __construct($portNumber, $hostName, $portlist='PortList.txt')
    {
        if (!is_array($portNumber)) {
            die('All port numbers must be defined in an array format');
        }
        parent::__construct($portNumber, $hostName, $portlist);
        $this->allPorts =$portNumber;
        asort($this->allPorts);
    }

    public function scanPort()
    {
        foreach ($this->allPorts as $this->portNumber) {
            if ($this->checkStatus()) {
                $this->scanResult[] = array(
                    'Port Number' => $this->portNumber,
                    'Port Name' => $this->getPortName(),
                    'Host Name' => $this->hostName,
                    'Scan Result' => 'Port Open',
                );
            } else {
                $this->scanResult[] = array(
                    'Port Number' => $this->portNumber,
                    'Port Name' => $this->getPortName(),
                    'Host Name' => $this->hostName,
                    'Scan Result' => 'Port Closed',
                );
            }
        }
        return $this->scanResult;
    }
}