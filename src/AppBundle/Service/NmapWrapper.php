<?php

namespace AppBundle\Service;

use Nmap\Host;
use Nmap\Nmap;

class NmapWrapper
{
    private Nmap $nmapInstance;

    public function __construct()
    {
        $this->nmapInstance = Nmap::create();
    }

    /**
     * @param array $arguments
     * @return Host[]
     */
    public function discoverIpsOnSubnet(array $arguments): array
    {
        $hosts = $this->nmapInstance->scan([$arguments['range']]);
    }


}