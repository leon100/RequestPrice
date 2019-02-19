<?php

namespace Leon\RequestPrice\Block;

use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Data\Form\FormKey;

class ModalOverlay extends Template
{

    /**
     * @var Registry
     */
    protected $registry;
    /**
     * @var FormKey
     */
    protected $formKey;
    /**
     * @var Product
     */
    private $product;

    public function __construct(Template\Context $context,
                                FormKey $formKey,
                                Registry $registry,
                                array $data)
    {
        $this->registry = $registry;
        $this->formKey = $formKey;
        parent::__construct($context, $data);
    }

    /**
     * get product SKU
     *
     * @return string
     */
    public function getSKU()
    {
        return $this->getProduct()->getSKU();
    }

    /**
     * @return Product
     */
    private function getProduct()
    {
        if (is_null($this->product)) {
            $this->product = $this->registry->registry('product');

            if (!$this->product->getId()) {
                throw new LocalizedException(__('Failed to initialize product'));
            }
        }

        return $this->product;
    }

    /**
     * get form key
     *
     * @return string
     */
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }

}