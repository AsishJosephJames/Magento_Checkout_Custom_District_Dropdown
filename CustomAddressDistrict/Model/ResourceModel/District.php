<?php

namespace Fingent\CustomAddressDistrict\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class District
 * @package Fingent\CustomAddressDistrict\Model\ResourceModel
 */
class District extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('directory_district', 'district_id');
    }
}