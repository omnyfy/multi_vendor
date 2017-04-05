<?php
/**
 * Project: Omnyfy Multi Vendor.
 * User: jing
 * Date: 5/4/17
 * Time: 11:09 AM
 */

namespace Omnyfy\Vendor\Model\ResourceModel\Location;

use Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Omnyfy\Vendor\Model\Location', 'Omnyfy\Vendor\Model\ResourceModel\Location');
    }
}