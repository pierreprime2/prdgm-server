<?php

namespace AppBundle\Service;

use Symfony\Component\Process\ProcessUtils;

class Nmap extends \Nmap\Nmap
{
    private $enableScanPing = false;

    private $enableRaw = false;

    private $enableHostnameIdentification = false;

    private $enableScanTcpSyn = false;

    private $enableUdpScan = false;

    private $enableTcpScan = false;

    // 0 : paranoid, 1 : sneaky, 2 : polite, 3 : normal (default), 4 : aggressive, 5 : insane
    private $aggressivityLevel = 3;

    private $enableFastScan = false;

    public function scan(array $targets, array $ports = array())
    {
        $targets = implode(' ', array_map(function ($target) {
            return ProcessUtils::escapeArgument($target);
        }, $targets));

        $options = array();
        if (true === $this->enableOsDetection) {
            $options[] = '-O';
        }

        if (true === $this->enableServiceInfo) {
            $options[] = '-sV';
        }

        if (true === $this->enableVerbose) {
            $options[] = '-v';
        }

        if (true === $this->disablePortScan) {
            $options[] = '-sn';
        } elseif (!empty($ports)) {
            $options[] = '-p '.implode(',', $ports);
        }

        if (true === $this->disableReverseDNS) {
            $options[] = '-n';
        }

        if (true == $this->treatHostsAsOnline) {
            $options[] = '-Pn';
        }

        $options[] = '-oX';
        $command   = sprintf('%s %s %s %s',
            $this->executable,
            implode(' ', $options),
            ProcessUtils::escapeArgument($this->outputFile),
            $targets
        );

        $this->executor->execute($command);

        if (!file_exists($this->outputFile)) {
            throw new \RuntimeException(sprintf('Output file not found ("%s")', $this->outputFile));
        }

        return $this->parseOutputFile($this->outputFile);
    }
}