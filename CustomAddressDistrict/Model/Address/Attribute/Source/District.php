<?php


namespace Fingent\CustomAddressDistrict\Model\Address\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\Table;
use Fingent\CustomAddressDistrict\Model\DistrictFactory;

/**
 * Class District
 * @package Fingent\CustomAddressDistrict\Model\Address\Attribute\Source
 */
class District extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * @var $districtCollection
     */
    protected DistrictFactory $districtCollection;

    /**
     * District constructor.
     * @param DistrictFactory $districtCollection
     */
    public function __construct(
        DistrictFactory $districtCollection
    ) {
        $this->district = $districtCollection;
    }

    /**
     * @return array
     *
     * get the district table collection in sourcemodel
     */
    public function getAllOptions()
    {
        $collection = $this->district->create()->getCollection();
        $collection->getData();
        foreach ($collection as $yeezy) {
            $opt[] = array(
                'value' => $yeezy['district_name'],
                'label' => $yeezy['district_name']
            );
        }
        return $opt;
    }
}
