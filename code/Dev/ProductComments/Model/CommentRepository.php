<?php

namespace Dev\ProductComments\Model;

use Dev\ProductComments\Api\CommentRepositoryInterface;
use Dev\ProductComments\Api\Data\CommentInterface;
use Dev\ProductComments\Model\ResourceModel\Comment\CollectionFactory;
use Dev\ProductComments\Model\CommentFactory;

class CommentRepository implements CommentRepositoryInterface
{
    protected $commentFactory;

    protected $collectionFactory;

    public function __construct(CommentFactory $commentFactory, CollectionFactory $collectionFactory)
    {
        $this->commentFactory = $commentFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param $id
     * @return mixed|void
     */
    public function getById($id)
    {
        $comment = $this->commentFactory->create();
        $comment->getResource()->load($comment, $id);
        return $comment;
    }

    /**
     * @param $productId
     * @return mixed
     */
    public function getList($productId)
    {
        $comment = $this->collectionFactory->create();

        $collection = $comment
            ->addFieldToFilter('product_id', $productId)
            ->addFieldToFilter('status', 1)
            ->setOrder('created_at', 'desc')
            ->getItems();

        return $collection;
    }

    /**
     * @param CommentInterface $comment
     * @return CommentInterface
     */
    public function save(CommentInterface $comment)
    {
        $comment->getResource()->save($comment);
        return $comment;
    }

    /**
     * @param CommentInterface $comment
     * @return void
     */
    public function delete(CommentInterface $comment)
    {
        $comment->getResource()->delete($comment);
    }
}
