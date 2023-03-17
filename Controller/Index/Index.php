<?php
/**
 * @author Devcrew Team
 * @copyright Copyright (c) 2023 Devcrew {http://devcrew.io}
 * Date: 17/01/2023
 * Time: 3:01 PM
 */
namespace Devcrew\MaintenancePage\Controller\Index;

use Devcrew\MaintenancePage\Helper\Data;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Controller class Index
 *
 * Class Index
 */
class Index extends Action
{
    /**
     * @var Data
     */
    private $helperData;

    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @param Context $context
     * @param Data $helperData
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        Data $helperData,
        PageFactory $pageFactory
    ) {
        $this->helperData = $helperData;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * Execute function to show maintenance page data
     *
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        if ($this->helperData->isEnabled()) {
            $resultPage = $this->pageFactory->create();
            $resultPage->getConfig()->getTitle()->set('Maintenance Page');
            return $resultPage;
        } else {
            return $this->_redirect('');
        }
    }
}
