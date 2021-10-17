<?php

namespace Dev\ProductComments\Model\ResourceModel\Comment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Dev\ProductComments\Model\Comment;
use Dev\ProductComments\Model\ResourceModel\Comment as ResourceModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'comment_id';
    protected $_eventPrefix = 'product_comments_collection';
    protected $_eventObject = 'comment_collection';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(Comment::class, ResourceModel::class);
    }
}
