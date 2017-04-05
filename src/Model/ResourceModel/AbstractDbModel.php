<?php
/**
 * Project: Omnyfy Multi Vendor.
 * User: jing
 * Date: 5/4/17
 * Time: 10:11 AM
 */

namespace Omnyfy\Vendor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

abstract class AbstractDbModel extends AbstractDb
{
    abstract protected function getUpdateFields();

    public function bulkSave($data) {
        if (empty($data)) {
            return;
        }

        $conn = $this->getConnection();

        $conn->insertOnDuplicate(
            $this->getMainTable(),
            $data,
            $this->getUpdateFields()
        );
    }

    public function remove($data) {
        if (empty($data)) {
            return;
        }

        $conn = $this->getConnection();

        $condition = [];
        foreach($data as $key => $values) {
            if (is_string($key) && !is_numeric($key)) {
                if (is_array($values)) {
                    $condition[] = $conn->quoteInto($key. ' IN (?}', $values);
                }
                else{
                    $condition[] = $conn->quoteInto($key. '=?', $values);
                }
            }
        }

        if (empty($condition)) {
            return;
        }

        $conn->delete($this->getMainTable(), $condition);
    }
}