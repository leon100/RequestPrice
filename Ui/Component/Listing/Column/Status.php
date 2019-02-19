<?php

namespace Leon\RequestPrice\Ui\Component\Listing\Column;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Leon\RequestPrice\Model\Bid;

class Status extends Column
{
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                if ($items['status'] == Bid::BID_STATUS_NEW) {
                    $items['status'] = 'New';
                } elseif ($items['status'] == Bid::BID_STATUS_IN_PROGRESS) {
                    $items['status'] = 'In Progress';
                } elseif ($items['status'] == Bid::BID_STATUS_CLOSED) {
                    $items['status'] = 'Closed';
                }
            }
        }
        return $dataSource;
    }
}