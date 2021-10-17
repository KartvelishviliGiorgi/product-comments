<?php

namespace Dev\ProductComments\Api;

use Dev\ProductComments\Api\Data\CommentInterface;

interface CommentRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $productId
     * @return mixed
     */
    public function getList($productId);

    /**
     * @param CommentInterface $comment
     * @return CommentInterface
     */
    public function save(CommentInterface $comment);

    /**
     * @param CommentInterface $comment
     * @return void
     */
    public function delete(CommentInterface $comment);
}
