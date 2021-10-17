<?php

namespace Dev\ProductComments\Block\Widget;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Catalog\Helper\Image;
use Magento\Framework\Pricing\Helper\Data;

class Products extends Template implements BlockInterface
{
    protected $_template = 'widget/products.phtml';

    private $productRepository;

    private $criteriaBuilder;

    private $imageHelper;

    private $dataHelper;

    public function __construct(
        Template\Context $context,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $criteriaBuilder,
        Image $imageHelper,
        Data $dataHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->productRepository = $productRepository;
        $this->criteriaBuilder = $criteriaBuilder;
        $this->imageHelper = $imageHelper;
        $this->dataHelper = $dataHelper;
    }

    public function getProductCollection($maxProducts)
    {
        $criteria = $this->criteriaBuilder->addFilter('Product_Comments', 'yes')->create()->setPageSize($maxProducts);

        return $this->productRepository->getList($criteria)->getItems();
    }

    public function getItemImage($product)
    {
        return $this->imageHelper->init($product, 'product_base_image')->getUrl();
    }

    public function getPrice($price)
    {
        return $this->dataHelper->currency($price, true, false);
    }
}
