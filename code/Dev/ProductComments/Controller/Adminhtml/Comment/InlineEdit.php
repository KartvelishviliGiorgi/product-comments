<?php

namespace Dev\ProductComments\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Cms\Model\Block;
use Dev\ProductComments\Api\CommentRepositoryInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\Json;
use Exception;

class InlineEdit extends Action
{
    protected $jsonFactory;

    private $commentRepository;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        CommentRepositoryInterface $commentRepository
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->commentRepository = $commentRepository;
    }

    public function execute()
    {
        /**
         * @var Json $resultJson
         */

        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);

            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelid) {
                    /** @var Block $block */
                    $model = $this->commentRepository->getById($modelid);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$modelid]));
                        $this->commentRepository->save($model);
                    } catch (Exception $e) {
                        $messages[] = "[Mymodel ID: {$modelid}]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData(['messages' => $messages, 'error' => $error]);
    }
}
