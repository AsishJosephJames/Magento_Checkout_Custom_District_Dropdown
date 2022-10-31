<?php

namespace Fingent\CustomAddressDistrict\Model;

use Fingent\CustomAddressDistrict\Model\ResourceModel\District as DistrictResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class District
 * @package Fingent\CustomAddressDistrict\Model
 */
class District extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(DistrictResourceModel::class);
    }
}