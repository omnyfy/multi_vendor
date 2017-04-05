<?php
/**
 * Project: Omnyfy Multi Vendor.
 * User: jing
 * Date: 5/4/17
 * Time: 11:02 AM
 */
namespace Omnyfy\Vendor\Model\ResourceModel;

class Location extends AbstractDbModel
{
    protected function _construct()
    {
        $this->_init('omnyfy_location', 'location_id');
    }

    protected function getUpdateFields()
    {
        return [
            'priority',
            'name',
            'description',
            'address',
            'suburb',
            'region',
            'country',
            'postcode',
            'latitude',
            'longitude',
        ];
    }

    public function getLocationsByVendorId($vendorId)
    {
        return $this->getCollection()
            ->addFieldToFilter('vendor_id', $vendorId);
    }
}