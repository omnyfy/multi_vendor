<?php
/**
 * Project: Omnyfy Multi Vendor.
 * User: jing
 * Date: 5/4/17
 * Time: 10:58 AM
 */
namespace Omnyfy\Vendor\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Location extends AbstractModel implements LocationInterface, IdentityInterface
{
    const CACHE_TAG = 'omnyfy_vendor_location';

    protected function _construct()
    {
        $this->_init('Omnyfy\Vendor\Model\ResourceModel\Location');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}