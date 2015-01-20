<?php
abstract class PortScanner
{
    protected $portNumber;
    protected $portName;
    protected $hostName;
    protected $scanResult;

    protected function __construct($portNumber, $hostName)
    {

        $this->portNumber = $portNumber;
        $this->hostName = $this->cleanHostName($hostName);
        asort($this->portNumber);
    }

    public abstract function scanPort();

    protected function checkStatus()
    {
        $socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('TCP'));
        if (@socket_connect($socket, $this->hostName, $this->portNumber)) {
            return true;
        } else {
            return false;
        }
    }

    protected function getPortName()
    {

        $fileName = 'PortList.txt';


        $portList = file($fileName);
        $nameFound = '';
        foreach ($portList as $portDetails) {
            $portDetailing = explode('||', $portDetails);
            if ($portDetailing[0] != null) {
                if ($this->portNumber == trim($portDetailing[0])) {
                    $this->portName = $portDetailing[1];
                    $nameFound = 1;
                }

                if ($nameFound != 1) {
                    $this->portName = 'Not Recognized';
                }
            }

        }
        return trim($this->portName);
    }

    private function  cleanHostName($hostName)
    {
        $schemes = array('http://','https://');
        foreach($schemes as $scheme ) {
            if(strpos($hostName,$scheme)===0) {
                $hostName = str_replace($scheme,'',$hostName);
            }
        }
        return $hostName;
    }
}