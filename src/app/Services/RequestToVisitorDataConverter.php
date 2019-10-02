<?php

namespace App\Services;

use Illuminate\Http\Request;

class RequestToVisitorDataConverter
{
    private $ipToRegionConverter;

    public function __construct(IpToRegionConverter $ipToRegionConverter)
    {
        $this->ipToRegionConverter = $ipToRegionConverter;
    }

    public function convert(Request $request)
    {
        $ip = $request->getClientIp();
        $region = $this->getRegionByIp($ip);

        $userAgentHeader = $request->header('User-Agent');
        $browserInfo = get_browser($userAgentHeader, true);
        $browserName = $browserInfo['browser'];
        $browserVersion = $browserInfo['version'];
        $platform = $browserInfo['platform'] ?? null;

        return [
            'ip' => $ip,
            'region' => $region,
            'browser_name' => $browserName,
            'browser_version' => $browserVersion,
            'platform' => $platform,
        ];
    }

    private function getRegionByIp(string $ipAddress)
    {
        return $this->ipToRegionConverter->getRegionById($ipAddress);
    }
}
