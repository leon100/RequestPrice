<?php

namespace Leon\RequestPrice\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Leon\RequestPrice\Model\Bid;

/**
 * Class Status
 */
class Status implements OptionSourceInterface
{

    public static function getOptionArray()
    {
        return [
            Bid::BID_STATUS_NEW => __('New'),
            Bid::BID_STATUS_IN_PROGRESS => __('In Progress'),
            Bid::BID_STATUS_CLOSED => __('Closed')
        ];
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $res = [];
        foreach (self::getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }
        return $res;
    }
}