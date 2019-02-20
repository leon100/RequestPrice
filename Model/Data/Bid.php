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

namespace Leon\RequestPrice\Model\Data;

use Leon\RequestPrice\Api\Data\BidInterface;

class Bid extends \Magento\Framework\Api\AbstractExtensibleObject implements BidInterface
{

    /**
     * Get bid_id
     * @return string|null
     */
    public function getBidId()
    {
        return $this->_get(self::BID_ID);
    }

    /**
     * Set bid_id
     * @param string $bidId
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     */
    public function setBidId($bidId)
    {
        return $this->setData(self::BID_ID, $bidId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Leon\RequestPrice\Api\Data\BidExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Leon\RequestPrice\Api\Data\BidExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Leon\RequestPrice\Api\Data\BidExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get email
     * @return string|null
     */
    public function getEmail()
    {
        return $this->_get(self::EMAIL);
    }

    /**
     * Set email
     * @param string $email
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get comment
     * @return string|null
     */
    public function getComment()
    {
        return $this->_get(self::COMMENT);
    }

    /**
     * Set comment
     * @param string $comment
     * @return \Leon\RequestPrice\Api\Data\BidInterface
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }
}
