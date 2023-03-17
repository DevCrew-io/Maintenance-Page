<?php
/**
 * @author Devcrew Team
 * @copyright Copyright (c) 2023 Devcrew {http://devcrew.io}
 * Date: 17/01/2023
 * Time: 2:35 PM
 */
namespace Devcrew\MaintenancePage\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Cms\Model\Wysiwyg\Config as WysiwygConfig;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Block class Editor
 *
 * Class Editor
 */
class Editor extends Field
{
    /**
     * @var WysiwygConfig
     */
    protected $wysiwygConfig;

    /**
     * @param Context $context
     * @param WysiwygConfig $wysiwygConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        WysiwygConfig $wysiwygConfig,
        array $data = []
    ) {
        $this->wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $data);
    }

    /**
     * Get element html
     *
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $element->setWysiwyg(true);
        $element->setConfig($this->wysiwygConfig->getConfig([
            'add_variables' => false,
            'add_widgets' => true,
            'add_images' => true
        ]));
        return parent::_getElementHtml($element);
    }
}
