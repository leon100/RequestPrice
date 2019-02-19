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

namespace Leon\RequestPrice\Controller\Index;

use Leon\RequestPrice\Model\Bid;

class Saverequest extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    protected $jsonHelper;
    protected $formKeyValidator;
    protected $bidModel;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        Bid $bidModel
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->jsonHelper = $jsonHelper;
        $this->formKeyValidator = $formKeyValidator;
        $this->bidModel = $bidModel;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {

            $post = $this->getRequest()->getPostValue();

            if (!$post) {
                throw new \Magento\Framework\Exception\InputException(
                    __('Empty post')
                );
            }
            if (!$this->formKeyValidator->validate($this->getRequest())) {
                throw new \Magento\Framework\Exception\InputException(
                    __('Oops...')
                );
            }

            if ($post['sku'] == "" || $post['customer_name'] == "" || $post['customer_email'] == "") {
                throw new \Magento\Framework\Exception\InputException(
                    __('Empty input')
                );
            }

            $data = [
                'sku' => $post['sku'],
                'name' => $post['customer_name'],
                'email' => $post['customer_email'],
                'comment' => $post['customer_comment'],
                'status' => Bid::BID_STATUS_NEW
            ];
            $this->bidModel->setData($data)->save();

            return $this->jsonResponse('ok');
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            return $this->jsonResponse($e->getMessage());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            return $this->jsonResponse($e->getMessage());
        }
    }

    /**
     * Create json response
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function jsonResponse($response = '')
    {
        return $this->getResponse()->representJson(
            $this->jsonHelper->jsonEncode($response)
        );
    }
}