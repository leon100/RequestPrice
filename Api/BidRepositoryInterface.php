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

namespace Leon\RequestPrice\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface BidRepositoryInterface
{

    /**
     * Save bid
     * @param \Leon\RequestPrice\Api\Data\BidInterface $bid
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Leon\RequestPrice\Api\Data\BidInterface $bid
    );

    /**
     * Retrieve bid
     * @param string $bidId
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($bidId);

    /**
     * Retrieve bid matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Leon\RequestPrice\Api\Data\BidSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete bid
     * @param \Leon\RequestPrice\Api\Data\BidInterface $bid
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Leon\RequestPrice\Api\Data\BidInterface $bid
    );

    /**
     * Delete bid by ID
     * @param string $bidId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($bidId);
}
