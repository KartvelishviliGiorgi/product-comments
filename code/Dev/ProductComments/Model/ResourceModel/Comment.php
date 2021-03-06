<?php

namespace Dev\ProductComments\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Comment extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('product_comments', 'comment_id');
    }
}
