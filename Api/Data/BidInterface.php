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

namespace Leon\RequestPrice\Api\Data;

interface BidInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const CREATED_AT = 'created_at';
    const NAME = 'name';
    const COMMENT = 'comment';
    const BID_ID = 'bid_id';
    const STATUS = 'status';
    const EMAIL = 'email';

    /**
     * Get bid_id
     * @return string|null
     */
    public function getBidId();

    /**
     * Set bid_id
     * @param string $bidId
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     */
    public function setBidId($bidId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Leon\RequestPrice\Api\Data\BidExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Leon\RequestPrice\Api\Data\BidExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Leon\RequestPrice\Api\Data\BidExtensionInterface $extensionAttributes
    );

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     */
    public function setEmail($email);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     */
    public function setStatus($status);

    /**
     * Get comment
     * @return string|null
     */
    public function getComment();

    /**
     * Set comment
     * @param string $comment
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     */
    public function setComment($comment);
}
