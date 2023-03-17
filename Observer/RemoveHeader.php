<?php

namespace Devcrew\MaintenancePage\Observer;

use Devcrew\MaintenancePage\Helper\Data;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

/**
 * Remove all head section elements mode is enabled
 *
 * Class RemoveHeader
 */
class RemoveHeader implements ObserverInterface
{
    /**
     * @var Data
     */
    private $helperData;

    /**
     * @var RemoteAddress
     */
    private $remote;

    /**
     * @var Http
     */
    private $request;

    /**
     * @param Data $helperData
     * @param Http $request
     * @param RemoteAddress $remote
     */
    public function __construct(
        Data $helperData,
        Http $request,
        RemoteAddress $remote
    ) {
        $this->remote = $remote;
        $this->request = $request;
        $this->helperData = $helperData;
    }

    /**
     * Remove head section observer
     *
     * @param Observer $observer observer
     * @return void
     */

    public function execute(Observer $observer)
    {
        $route = $this->request->getRouteName();

        if (!$route || !$this->helperData->isEnabled()) {
            return;
        }

        if ($this->helperData->isIpWhiteListed($this->remote->getRemoteAddress())) {
            return;
        }

        $response = $observer->getEvent()->getResponse();
        $htmlContent = $response->getBody();
        $pattern = '~<head(.*?)</head>~Usi';
        $htmlContent = preg_replace($pattern, "<head><title>Maintenance Page</title></head>", $htmlContent);
        return $response->setBody($htmlContent);
    }
}
