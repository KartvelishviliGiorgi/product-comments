<?php

namespace Dev\ProductComments\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface CommentInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getProductId();

    /**
     * @param $id
     * @return void
     */
    public function setProductId($id);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getComment();

    /**
     * @param $comment
     * @return void
     */
    public function setComment($comment);

    /**
     * @return string
     */
    public function getDate();

    /**
     * @param $date
     * @return void
     */
    public function setDate($date);

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @param $status
     * @return void
     */
    public function setStatus($status);
}
