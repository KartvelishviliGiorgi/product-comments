<?php

namespace Dev\ProductComments\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Dev\ProductComments\Model\Comment;
use Dev\ProductComments\Model\ResourceModel\Comment as ResourceComment;
use Zend_Validate;
use Zend_Validate_Exception;
use Exception;

class SendComment extends Action
{
    private $commentModel;

    private $resourceModel;

    public function __construct(Context $context, Comment $commentModel, ResourceComment $resourceModel)
    {
        parent::__construct($context);
        $this->commentModel = $commentModel;
        $this->resourceModel = $resourceModel;
    }

    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $email = $this->getRequest()->getParam('email');
        $comment = $this->getRequest()->getParam('comment');
        $productId = $this->getRequest()->getParam('productId');

        try {
            if (!Zend_Validate::is($comment, 'NotEmpty')) {
                $this->messageManager->addErrorMessage('Comment must not be empty');
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            } elseif (!Zend_Validate::is($email, 'EmailAddress')) {
                $this->messageManager->addErrorMessage('Email address not valid');
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            } else {
                $this->commentModel
                    ->setData('product_id', $productId)
                    ->setData('email', $email)
                    ->setData('comment', $comment);
                try {
                    $this->resourceModel->save($this->commentModel);
                } catch (Exception $e) {
                }
                $this->messageManager->addSuccessMessage('Comment request has been sent. Wait for admin approve');
                $this->_eventManager->dispatch('comment_sent',['email'=>$email,'comment'=>$comment]);
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            }
        } catch (Zend_Validate_Exception $e) {
        }
    }
}
