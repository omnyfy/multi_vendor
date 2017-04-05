<?php
/**
 * Project: Omnyfy Multi Vendor.
 * User: jing
 * Date: 5/4/17
 * Time: 10:55 AM
 */
namespace Omnyfy\Vendor\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Omnyfy\Vendor\Model\Vendor', 'Omnyfy\Vendor\Model\ResourceModel\Vendor');
    }
}