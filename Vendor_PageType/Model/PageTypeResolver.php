<?php
namespace Vendor\PageType\Model;

use Vendor\PageType\Api\PageTypeResolverInterface;
use Magento\UrlRewrite\Model\UrlFinderInterface;
use Magento\UrlRewrite\Service\V1\Data\UrlRewrite;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\DataObject;
use Magento\Store\Api\StoreRepositoryInterface;

class PageTypeResolver implements PageTypeResolverInterface
{
    private UrlFinderInterface $urlFinder;
    private ProductRepositoryInterface $productRepository;
    private PageRepositoryInterface $pageRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private StoreRepositoryInterface $storeRepository;

    public function __construct(
        UrlFinderInterface $urlFinder,
        ProductRepositoryInterface $productRepository,
        PageRepositoryInterface $pageRepository,
        CategoryRepositoryInterface $categoryRepository,
        StoreRepositoryInterface $storeRepository
    ) {
        $this->urlFinder = $urlFinder;
        $this->productRepository = $productRepository;
        $this->pageRepository = $pageRepository;
        $this->categoryRepository = $categoryRepository;
        $this->storeRepository = $storeRepository;
    }

    public function resolve(string $deeplink)
    {
        $parsed = parse_url($deeplink);
        $path = trim($parsed['path'] ?? '', '/');
        $segments = explode('/', $path);

        $locale = strtolower($segments[0] ?? '');

        // @TODO: I need to fill in the store map for mumzworld
        $storeMap = [
            'en' => 'ae_en',
            'ar' => 'ae_ar',
            'sa-en' => 'sa_en',
            'sa-ar' => 'sa_ar',
        ];
        $storeCode = $storeMap[$locale] ?? 'default';

        array_shift($segments);
        $urlKey = implode('/', $segments);

        $store = $this->storeRepository->get($storeCode);
        $storeId = $store->getId();

        $rewrite = $this->urlFinder->findOneByData([
            UrlRewrite::REQUEST_PATH => $urlKey,
            UrlRewrite::STORE_ID => $storeId
        ]);

        if (!$rewrite) {
            if (str_contains($target, 'brand/landing/view')) {
    $id = $this->extractId($target);
    $brandLabel = 'Unknown';
    $brandId = $id;

    try {
        $attribute = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Eav\Model\Config::class)
            ->getAttribute('catalog_product', 'brand');

        $option = $attribute->getSource()->getOptionText($id);
        if ($option) {
            $brandLabel = $option;
        }
    } catch (\Exception $e) {}

    return new DataObject([
        'name' => $brandLabel,
        'sku' => null,
        'category_id' => null,
        'brandLabel' => $brandLabel,
        'brandId' => $brandId,
        'is_yalla_applied' => false,
        'response_type' => 'brand',
    ]);
}

return new DataObject([

                'name' => null,
                'sku' => null,
                'category_id' => null,
                'brandLabel' => null,
                'brandId' => null,
                'is_yalla_applied' => null,
                'response_type' => 'not_found',
            ]);
        }

        $target = $rewrite->getTargetPath();

        if (str_contains($target, 'catalog/product/view')) {
            $id = $this->extractId($target);
            $product = $this->productRepository->getById($id, false, $storeId, true);

            if (str_contains($target, 'brand/landing/view')) {
    $id = $this->extractId($target);
    $brandLabel = 'Unknown';
    $brandId = $id;

    try {
        $attribute = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Eav\Model\Config::class)
            ->getAttribute('catalog_product', 'brand');

        $option = $attribute->getSource()->getOptionText($id);
        if ($option) {
            $brandLabel = $option;
        }
    } catch (\Exception $e) {}

    return new DataObject([
        'name' => $brandLabel,
        'sku' => null,
        'category_id' => null,
        'brandLabel' => $brandLabel,
        'brandId' => $brandId,
        'is_yalla_applied' => false,
        'response_type' => 'brand',
    ]);
}

return new DataObject([

                'name' => $product->getName(),
                'sku' => $product->getSku(),
                'category_id' => $product->getCategoryIds()[0] ?? null,
                'brandLabel' => $product->getAttributeText('brand'),
                'brandId' => $product->getData('brand'),
                'is_yalla_applied' => (bool) $product->getData('is_yalla_applied'),
                'response_type' => 'product_details',
            ]);
        }

        if (str_contains($target, 'catalog/category/view')) {
            $id = $this->extractId($target);
            $category = $this->categoryRepository->get($id, $storeId);

            if (str_contains($target, 'brand/landing/view')) {
    $id = $this->extractId($target);
    $brandLabel = 'Unknown';
    $brandId = $id;

    try {
        $attribute = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Eav\Model\Config::class)
            ->getAttribute('catalog_product', 'brand');

        $option = $attribute->getSource()->getOptionText($id);
        if ($option) {
            $brandLabel = $option;
        }
    } catch (\Exception $e) {}

    return new DataObject([
        'name' => $brandLabel,
        'sku' => null,
        'category_id' => null,
        'brandLabel' => $brandLabel,
        'brandId' => $brandId,
        'is_yalla_applied' => false,
        'response_type' => 'brand',
    ]);
}

return new DataObject([

                'name' => $category->getName(),
                'sku' => null,
                'category_id' => $category->getId(),
                'brandLabel' => null,
                'brandId' => null,
                'is_yalla_applied' => null,
                'response_type' => 'product_list',
            ]);
        }

        if (str_contains($target, 'cms/page/view')) {
            $id = $this->extractId($target);
            $page = $this->pageRepository->getById($id);

            if (str_contains($target, 'brand/landing/view')) {
    $id = $this->extractId($target);
    $brandLabel = 'Unknown';
    $brandId = $id;

    try {
        $attribute = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Eav\Model\Config::class)
            ->getAttribute('catalog_product', 'brand');

        $option = $attribute->getSource()->getOptionText($id);
        if ($option) {
            $brandLabel = $option;
        }
    } catch (\Exception $e) {}

    return new DataObject([
        'name' => $brandLabel,
        'sku' => null,
        'category_id' => null,
        'brandLabel' => $brandLabel,
        'brandId' => $brandId,
        'is_yalla_applied' => false,
        'response_type' => 'brand',
    ]);
}

return new DataObject([

                'name' => $page->getTitle(),
                'sku' => null,
                'category_id' => null,
                'brandLabel' => null,
                'brandId' => null,
                'is_yalla_applied' => null,
                'response_type' => 'cms-page',
            ]);
        }

        if (str_contains($target, 'brand/landing/view')) {
    $id = $this->extractId($target);
    $brandLabel = 'Unknown';
    $brandId = $id;

    try {
        $attribute = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Eav\Model\Config::class)
            ->getAttribute('catalog_product', 'brand');

        $option = $attribute->getSource()->getOptionText($id);
        if ($option) {
            $brandLabel = $option;
        }
    } catch (\Exception $e) {}

    return new DataObject([
        'name' => $brandLabel,
        'sku' => null,
        'category_id' => null,
        'brandLabel' => $brandLabel,
        'brandId' => $brandId,
        'is_yalla_applied' => false,
        'response_type' => 'brand',
    ]);
}

return new DataObject([

            'name' => null,
            'sku' => null,
            'category_id' => null,
            'brandLabel' => null,
            'brandId' => null,
            'is_yalla_applied' => null,
            'response_type' => 'unknown',
        ]);
    }

    private function extractId(string $targetPath): ?int
    {
        parse_str(parse_url($targetPath, PHP_URL_QUERY), $params);
        return isset($params['id']) ? (int) $params['id'] : null;
    }
}
