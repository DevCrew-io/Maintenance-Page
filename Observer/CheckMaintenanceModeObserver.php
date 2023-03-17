<?php
/**
 * @author Devcrew Team
 * @copyright Copyright (c) 2023 Devcrew {http://devcrew.io}
 * Date: 17/01/2023
 * Time: 5:04 PM
 */
namespace Devcrew\MaintenancePage\Observer;

use Devcrew\MaintenancePage\Helper\Data;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\Response\Http as ResponseHttp;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

/**
 * Check maintenance mode is enabled
 *
 * Class CheckMaintenanceModeObserver
 */
class CheckMaintenanceModeObserver implements ObserverInterface
{
    /**
     * @var Data
     */
    private $helperData;

    /**
     * @var Http
     */
    private $request;

    /**
     * @var RedirectInterface
     */
    private $redirect;

    /**
     * @var RemoteAddress
     */
    private $remote;

    /**
     * @var ResponseHttp
     */
    private $response;

    /**
     * @param Http $request
     * @param Data $helperData
     * @param ResponseHttp $response
     * @param RedirectInterface $redirect
     * @param RemoteAddress $remote
     */
    public function __construct(
        Http              $request,
        Data              $helperData,
        ResponseHttp      $response,
        RedirectInterface $redirect,
        RemoteAddress     $remote
    ) {
        $this->helperData = $helperData;
        $this->request = $request;
        $this->redirect = $redirect;
        $this->response = $response;
        $this->remote = $remote;
    }

    /**
     * Maintenance Mode Observer Event
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

        if ($route == Data::MAINTENANCE_PAGE_ROUTE
            && $this->helperData->isIpWhiteListed($this->remote->getRemoteAddress())) {
            $this->redirect->redirect(
                $this->response,
                '/'
            );
        }

        if ($route != Data::MAINTENANCE_PAGE_ROUTE
            && !$this->helperData->isIpWhiteListed($this->remote->getRemoteAddress())) {
            $this->redirect->redirect(
                $this->response,
                Data::MAINTENANCE_PAGE_ROUTE . '/'
            );
        }
    }
}
