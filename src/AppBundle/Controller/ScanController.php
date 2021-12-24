<?php

namespace AppBundle\Controller;

use AppBundle\Service\NmapWrapper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

class ScanController extends Controller
{
    private NmapWrapper $nmapWrapper;

    public function __construct()
    {
        $this->nmapWrapper = new NmapWrapper();
    }

    /**
     * @Rest\View()
     * @Rest\Post("/discover-ips")
     */
    public function discoverIpsOnSubnet(Request $request)
    {
        $payload = json_decode($request->getContent(), true);

        $hosts = $this->nmapWrapper->discoverIpsOnSubnet($payload);

        return new JsonResponse([
            'message' => sprintf('You asked for IP scan on subnet %s', $payload['range']),
            'range' => $payload['range'],
        ]);
    }

    public function scanForOpenPorts(Request $request)
    {

    }

    public function identifyHostOperatingSystem(Request $request)
    {

    }

    public function identifyHostnames(Request $request)
    {

    }

    public function tcpSynAndUdpScan(Request $request)
    {

    }

    public function tcpConnectScan(Request $request)
    {

    }

    public function aggressiveHostScan(Request $request)
    {

    }

    public function fastScan(Request $request)
    {

    }
}