<?php


namespace Dev\ProductComments\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Dev\ProductComments\Api\Data\CommentInterface;
use Dev\ProductComments\Model\ResourceModel\Comment as ResourceModel;

class Comment extends AbstractExtensibleModel implements CommentInterface
{
    private const PRODUCT = 'product_id';
    private const EMAIL = 'email';
    private const COMMENT = 'comment';
    private const STATUS = 'status';
    private const DATE = 'created_at';

    /**
     * Pending comment status code
     */
    public const STATUS_PENDING = 0;

    /**
     * Approved comment status code
     */
    public const STATUS_APPROVED = 1;

    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getProductId()
    {
        return $this->getData(self::PRODUCT);
    }

    public function setProductId($id)
    {
        $this->setData(self::PRODUCT, $id);
    }

    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    public function setEmail($email)
    {
        $this->setData(self::EMAIL, $email);
    }

    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    public function setComment($comment)
    {
        $this->setData(self::COMMENT, $comment);
    }

    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    public function setStatus($status)
    {
        $this->setData(self::STATUS, $status);
    }

    public function getDate()
    {
        return $this->getData(self::DATE);
    }

    public function setDate($date)
    {
        $this->setData(self::DATE, $date);
    }
}
