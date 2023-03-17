<?php
/**
 * @author Devcrew Team
 * @copyright Copyright (c) 2023 Devcrew {http://devcrew.io}
 * Date: 17/01/2023
 * Time: 2:43 PM
 */
namespace Devcrew\MaintenancePage\Block;

use Devcrew\MaintenancePage\Helper\Data;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Block class maintenance
 *
 * Class Maintenance
 */
class Maintenance extends Template
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @param Context $context
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        Data $helperData
    ) {
        $this->helperData = $helperData;
        parent::__construct($context);
    }

    /**
     * Is feature enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->helperData->isEnabled();
    }

    /**
     * Get timer
     *
     * @return mixed
     */
    public function getTimer()
    {
        return $this->helperData->getTimer();
    }

    /**
     * Get end time
     *
     * @return mixed|string
     */
    public function getEndtime()
    {
        $timer = $this->getTimer();
        return $timer ? $this->helperData->getEndtime() : '';
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->helperData->getDescription();
    }

    /**
     * Get background image
     *
     * @return false|string
     */
    public function getBackgroundimage()
    {
        return $this->helperData->getBackgroundimage();
    }

    /**
     * Get social button
     *
     * @return string
     */
    public function getSocialButton()
    {
        return $this->helperData->getSocialButton();
    }

    /**
     * Get facebook link
     *
     * @return string
     */
    public function getFacebookLink()
    {
        return $this->helperData->getFacebookLink();
    }

    /**
     * Get linkedin link
     *
     * @return string
     */
    public function getLinkedinLink()
    {
        return $this->helperData->getLinkedinLink();
    }

    /**
     * Get youtube link
     *
     * @return string
     */
    public function getYoutubeLink()
    {
        return $this->helperData->getYoutubeLink();
    }
}
