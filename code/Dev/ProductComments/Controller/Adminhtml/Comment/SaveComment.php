<?php

namespace Dev\ProductComments\Controller\Adminhtml\Comment;

use Dev\ProductComments\Api\CommentRepositoryInterface;
use Dev\ProductComments\Api\Data\CommentInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Exception;

class SaveComment extends Action
{
    private $comment;
    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    /**
     * SaveComment constructor.
     * @param Context $context
     * @param CommentInterface $comment
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(
        Context $context,
        CommentInterface $comment,
        CommentRepositoryInterface $commentRepository
    ) {
        parent::__construct($context);
        $this->comment = $comment;
        $this->commentRepository = $commentRepository;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            try {
                $id = $this->getRequest()->getParam('comment_id');
                $model = $this->comment->load($id);
                $model->setData($data);
                $this->commentRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the comment.'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/add', ['comment_id' => $this->comment->getId()]);
                }
            } catch (Exception $exception) {
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}
