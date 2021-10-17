<?php

namespace Dev\ProductComments\Block\Adminhtml\Comment\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class GenericButton
{
    protected $urlBuilder;

    protected $registry;

    public function __construct(Context $context, Registry $registry)
    {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

    public function getId()
    {
        $comment = $this->registry->registry('comment');
        return $comment ? $comment->getId() : null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
