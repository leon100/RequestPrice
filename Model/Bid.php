<?php
/**
 * A Magento 2 module named Leon/RequestPrice
 * Copyright (C) 2018  
 * 
 * This file is part of Leon/RequestPrice.
 * 
 * Leon/RequestPrice is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Leon\RequestPrice\Model;

use Leon\RequestPrice\Api\Data\BidInterface;
use Leon\RequestPrice\Api\Data\BidInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Bid extends \Magento\Framework\Model\AbstractModel
{

    protected $bidDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'leon_requestprice_bid';

    const BID_STATUS_NEW = 0;
    const BID_STATUS_IN_PROGRESS = 1;
    const BID_STATUS_CLOSED = 2;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param BidInterfaceFactory $bidDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Leon\RequestPrice\Model\ResourceModel\Bid $resource
     * @param \Leon\RequestPrice\Model\ResourceModel\Bid\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        BidInterfaceFactory $bidDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Leon\RequestPrice\Model\ResourceModel\Bid $resource,
        \Leon\RequestPrice\Model\ResourceModel\Bid\Collection $resourceCollection,
        array $data = []
    ) {
        $this->bidDataFactory = $bidDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve bid model with bid data
     * @return BidInterface
     */
    public function getDataModel()
    {
        $bidData = $this->getData();
        
        $bidDataObject = $this->bidDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $bidDataObject,
            $bidData,
            BidInterface::class
        );
        
        return $bidDataObject;
    }
}
