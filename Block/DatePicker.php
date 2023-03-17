<?php
/**
 * @author Devcrew Team
 * @copyright Copyright (c) 2023 Devcrew {http://devcrew.io}
 * Date: 17/01/2023
 * Time: 2:33 PM
 */
namespace Devcrew\MaintenancePage\Block;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Stdlib\DateTime;

/**
 * Class DatePicker
 *
 * Show date time
 */
class DatePicker extends Field
{
    /**
     * Datepicker renderer function
     *
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $element->setDateFormat(DateTime::DATE_INTERNAL_FORMAT);
        $element->setTimeFormat('HH:mm:ss'); //set date and time as per your need
        $element->setShowsTime(true);
        return parent::render($element);
    }
}
