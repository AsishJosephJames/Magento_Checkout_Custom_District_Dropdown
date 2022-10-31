<?php

namespace Fingent\CustomAddressDistrict\Model\ResourceModel\District;

use Fingent\CustomAddressDistrict\Model\District as DistrictModel;
use Fingent\CustomAddressDistrict\Model\ResourceModel\District as DistrictResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Fingent\CustomAddressDistrict\Model\ResourceModel\District
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            DistrictModel::class,
            DistrictResourceModel::class
        );
    }
}
