<?php
/**
 * Project: Omnyfy Multi Vendor.
 * User: jing
 * Date: 5/4/17
 * Time: 10:03 AM
 */

namespace Omnyfy\Vendor\Model\ResourceModel;


class Vendor extends AbstractDbModel
{
    protected function _construct()
    {
        $this->_init('omnyfy_vendor', 'vendor_id');
    }

    protected function getUpdateFields()
    {
        return [
            'name',
            'status',
            'address',
            'phone',
            'email',
            'fax',
            'social_media',
            'description',
            'abn',
            'logo',
            'banner'
        ];
    }
}