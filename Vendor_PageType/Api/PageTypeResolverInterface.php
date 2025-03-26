<?php
namespace Vendor\PageType\Api;

interface PageTypeResolverInterface
{
    /**
     * @param string $deeplink
     * @return \Magento\Framework\DataObject
     */
    public function resolve(string $deeplink);
}
