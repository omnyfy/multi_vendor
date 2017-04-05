<?php
/**
 * Project: Omnyfy Multi Vendor.
 * User: jing
 * Date: 5/4/17
 * Time: 9:57 AM
 */

namespace Omnyfy\Vendor\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;


class Vendor extends AbstractModel implements VendorInterface, IdentityInterface
{
    const CACHE_TAG = 'omnyfy_vendor_vendor';

    protected function _construct()
    {
        $this->_init('Omnyfy\Vendor\Model\ResourceModel\Vendor');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}