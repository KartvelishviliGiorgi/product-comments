<?php
namespace Dev\ProductComments\Controller\Adminhtml\Comment;

use Dev\ProductComments\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

class Disapprove extends Action
{
    protected $filter;

    protected $collectionFactory;

    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            foreach ($collection as $item) {
                $item->setStatus(0);
                $item->save();
            }
            $this->messageManager->addSuccessMessage(__('Elements have been disapproved.'));
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            return $resultRedirect->setPath('*/*/');
        } catch (LocalizedException $e) {
            return null;
        }
    }
}
