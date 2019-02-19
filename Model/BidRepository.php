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

use Leon\RequestPrice\Api\BidRepositoryInterface;
use Leon\RequestPrice\Api\Data\BidSearchResultsInterfaceFactory;
use Leon\RequestPrice\Api\Data\BidInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Leon\RequestPrice\Model\ResourceModel\Bid as ResourceBid;
use Leon\RequestPrice\Model\ResourceModel\Bid\CollectionFactory as BidCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;

class BidRepository implements BidRepositoryInterface
{

    protected $resource;

    protected $bidFactory;

    protected $bidCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataBidFactory;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;

    /**
     * @param ResourceBid $resource
     * @param BidFactory $bidFactory
     * @param BidInterfaceFactory $dataBidFactory
     * @param BidCollectionFactory $bidCollectionFactory
     * @param BidSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceBid $resource,
        BidFactory $bidFactory,
        BidInterfaceFactory $dataBidFactory,
        BidCollectionFactory $bidCollectionFactory,
        BidSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->bidFactory = $bidFactory;
        $this->bidCollectionFactory = $bidCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataBidFactory = $dataBidFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Leon\RequestPrice\Api\Data\BidInterface $bid
    ) {
        /* if (empty($bid->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $bid->setStoreId($storeId);
        } */
        
        $bidData = $this->extensibleDataObjectConverter->toNestedArray(
            $bid,
            [],
            \Leon\RequestPrice\Api\Data\BidInterface::class
        );
        
        $bidModel = $this->bidFactory->create()->setData($bidData);
        
        try {
            $this->resource->save($bidModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the bid: %1',
                $exception->getMessage()
            ));
        }
        return $bidModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($bidId)
    {
        $bid = $this->bidFactory->create();
        $this->resource->load($bid, $bidId);
        if (!$bid->getId()) {
            throw new NoSuchEntityException(__('bid with id "%1" does not exist.', $bidId));
        }
        return $bid->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->bidCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Leon\RequestPrice\Api\Data\BidInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Leon\RequestPrice\Api\Data\BidInterface $bid
    ) {
        try {
            $bidModel = $this->bidFactory->create();
            $this->resource->load($bidModel, $bid->getBidId());
            $this->resource->delete($bidModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the bid: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($bidId)
    {
        return $this->delete($this->getById($bidId));
    }
}
