<?php
/**
 * @author Devcrew Team
 * @copyright Copyright (c) 2023 Devcrew {http://devcrew.io}
 * Date: 17/01/2023
 * Time: 4:54 PM
 */
namespace Devcrew\MaintenancePage\Helper;

use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Helper class Data
 *
 * Class Data
 */
class Data extends AbstractHelper
{
    /**
     * Image directory path
     */
    public const IMAGE_DIR_PATH = 'devcrew/maintenancepage/';

    /**#@+
     * Route
     */
    public const MAINTENANCE_PAGE_ROUTE = 'devcrewmaintenance';
    /**#@-*/

    /**#@+
     * System configurations XML paths
     */
    public const XML_PATH_IS_ENABLED = 'maintenancepage/general/enable';
    public const XML_PATH_WHITELIST_IP = 'maintenancepage/general/whitelist_ip';
    public const XML_PATH_TIMER = 'maintenancepage/general/timer';
    public const XML_PATH_END_TIME = 'maintenancepage/general/end_date';
    public const XML_PATH_DESCRIPTION = 'maintenancepage/general/description';
    public const XML_PATH_BACKGROUND_IMAGE = 'maintenancepage/general/background_image';
    public const XML_PATH_SOCIAL_BUTTON = 'maintenancepage/general/social_button';
    public const XML_PATH_FACEBOOK = 'maintenancepage/general/facebook';
    public const XML_PATH_LINKEDIN = 'maintenancepage/general/linkedin';
    public const XML_PATH_YOUTUBE = 'maintenancepage/general/youtube';
    /**#@-*/

    /**
     * @var FilterProvider
     */
    private $filterProvider;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param Context $context
     * @param FilterProvider $filterProvider
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        FilterProvider $filterProvider,
        StoreManagerInterface $storeManager
    ) {
        $this->filterProvider = $filterProvider;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * Check if MaintenancePage feature is enabled
     *
     * @param string $scope
     * @return boolean
     */
    public function isEnabled($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_IS_ENABLED,
            $scope
        );
    }

    /**
     * Get white list IP
     *
     * @param string $scope
     * @return mixed
     */
    public function getWhitelistIp($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_WHITELIST_IP,
            $scope
        );
    }

    /**
     * Get timer
     *
     * @param string $scope
     * @return mixed
     */
    public function getTimer($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_TIMER,
            $scope
        );
    }

    /**
     * Get end time
     *
     * @param string $scope
     * @return mixed
     */
    public function getEndtime($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $endTime = '';
        if ($this->getTimer()) {
            $endTime = $this->scopeConfig->getValue(
                self::XML_PATH_END_TIME,
                $scope
            );
        }
        return $endTime;
    }

    /**
     * Get description
     *
     * @param string $scope
     * @return string
     */
    public function getDescription($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $description = '';
        try {
            $description = $this->scopeConfig->getValue(
                self::XML_PATH_DESCRIPTION,
                $scope
            );
            if ($description) {
                $description = $this->filterProvider->getPageFilter()->filter($description);
            }
        } catch (\Exception $exception) {
            $this->_logger->error($exception->getMessage());
        }
        return $description;
    }

    /**
     * Get background image
     *
     * @param string $scope
     * @return false|string
     */
    public function getBackgroundimage($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $backgroundImage = $this->scopeConfig->getValue(
            self::XML_PATH_BACKGROUND_IMAGE,
            $scope
        );
        return $backgroundImage ? $this->getMediaUrl() . self::IMAGE_DIR_PATH . $backgroundImage : '';
    }

    /**
     * Get social button
     *
     * @param string $scope
     * @return string
     */
    public function getSocialButton($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $socialButton = '';
        try {
            $socialButton = $this->scopeConfig->getValue(
                self::XML_PATH_SOCIAL_BUTTON,
                $scope
            );
        } catch (\Exception $exception) {
            $this->_logger->error($exception->getMessage());
        }
        return $socialButton;
    }

    /**
     * Get facebook link
     *
     * @param string $scope
     * @return string
     */
    public function getFacebookLink($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $facebook = '';
        if (!$this->getSocialButton()) {
            return $facebook;
        }
        try {
            $facebook = $this->scopeConfig->getValue(
                self::XML_PATH_FACEBOOK,
                $scope
            );
        } catch (\Exception $exception) {
            $this->_logger->error($exception->getMessage());
        }
        return $facebook;
    }

    /**
     * Get linkedin link
     *
     * @param string $scope
     * @return string
     */
    public function getLinkedinLink($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $linkedin = '';
        if (!$this->getSocialButton()) {
            return $linkedin;
        }
        try {
            $linkedin = $this->scopeConfig->getValue(
                self::XML_PATH_LINKEDIN,
                $scope
            );
        } catch (\Exception $exception) {
            $this->_logger->error($exception->getMessage());
        }
        return $linkedin;
    }

    /**
     * Get youtube link
     *
     * @param string $scope
     * @return string
     */
    public function getYoutubeLink($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $youtube = '';
        if (!$this->getSocialButton()) {
            return $youtube;
        }
        try {
            $youtube = $this->scopeConfig->getValue(
                self::XML_PATH_YOUTUBE,
                $scope
            );
        } catch (\Exception $exception) {
            $this->_logger->error($exception->getMessage());
        }
        return $youtube;
    }

    /**
     * Get media url
     *
     * @return string
     */
    public function getMediaUrl()
    {
        $mediaUrl = '';
        try {
            $mediaUrl = $this->storeManager->getStore()
                ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        } catch (\Exception $exception) {
            $this->_logger->error($exception->getMessage());
        }
        return $mediaUrl;
    }

    /**
     * Is current Ip white listed
     *
     * @param string $currentIp
     * @return bool
     */
    public function isIpWhiteListed($currentIp = '')
    {
        $allowedIP = [];
        $allowedIP = array_merge(
            $allowedIP,
            array_map('trim', explode(',', (string)$this->getWhitelistIp()))
        );
        return in_array($currentIp, $allowedIP);
    }
}
