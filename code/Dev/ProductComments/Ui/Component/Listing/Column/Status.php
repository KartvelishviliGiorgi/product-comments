<?php

namespace Dev\ProductComments\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Dev\ProductComments\Model\Comment;

class Status extends Column implements OptionSourceInterface
{
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Get comment statuses with their codes
     *
     * @return array
     */
    public function getCommentStatuses()
    {
        return [
            Comment::STATUS_PENDING => __('Not Approved'),
            Comment::STATUS_APPROVED => __('Approved')
        ];
    }

    public function prepareDataSource(array $dataSource)
    {
        $dataSource = parent::prepareDataSource($dataSource);
        $options = $this->getCommentStatuses();

        if (empty($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as &$item) {
            if (isset($options[$item['status']])) {
                $item['status'] = $options[$item['status']];
            }
        }

        return $dataSource;
    }

    /**
     * Get comment statuses as option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $result = [];

        foreach ($this->getCommentStatuses() as $value => $label) {
            $result[] = ['value' => $value, 'label' => $label];
        }

        return $result;
    }
}
