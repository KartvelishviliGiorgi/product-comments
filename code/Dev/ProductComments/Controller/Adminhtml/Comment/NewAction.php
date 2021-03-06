<?php

namespace Dev\ProductComments\Controller\Adminhtml\Comment;

use Dev\ProductComments\Model\Comment;
use Dev\ProductComments\Model\ResourceModel\Comment as ResourceComment;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Exception;

class NewAction extends Action
{
    /**
     * @var Comment
     */
    private $commentModel;
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var ResourceComment
     */
    private $resourceModel;

    /**
     * NewAction constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Comment $commentModel
     * @param ResourceComment $resourceModel
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Comment $commentModel,
        ResourceComment $resourceModel
    ) {
        parent::__construct($context);
        $this->commentModel = $commentModel;
        $this->resultPageFactory = $resultPageFactory;
        $this->resourceModel = $resourceModel;
    }

    /**
     * @return ResultInterface
     * @throws Exception
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $commentDatas = $this->getRequest()->getParam('comment_id');

        if (is_array($commentDatas)) {
            $this->commentModel->setData($this->resourceModel->save($commentDatas));

            return $resultRedirect->setPath('*/*/new');
        }
        return $this->resultPageFactory->create();
    }
}
