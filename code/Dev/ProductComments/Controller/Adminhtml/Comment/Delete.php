<?php

namespace Dev\ProductComments\Controller\Adminhtml\Comment;

use Dev\ProductComments\Api\CommentRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Exception;

class Delete extends Action
{
    protected $commentRepository;

    public function __construct(Context $context, CommentRepositoryInterface $commentRepository)
    {
        parent::__construct($context);
        $this->commentRepository = $commentRepository;
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $id = $params['id'];
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        try {
            $contact = $this->commentRepository->getById($id);

            if (!$contact) {
                $this->messageManager->addErrorMessage(__('Unable to proceed. Please, try again.'));
                return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            }
            try {
                $this->commentRepository->delete($contact);
                $this->messageManager->addSuccessMessage(__('Comment has been deleted !'));
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage(__('Error while trying to delete comment: '));
                return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            }
        } catch (Exception $e) {
        }
        return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
    }
}
