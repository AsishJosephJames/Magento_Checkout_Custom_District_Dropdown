<?php

namespace Fingent\CustomAddressDistrict\Setup\Patch\Data;

use Fingent\CustomAddressDistrict\Model\DistrictFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class CreateDistricts
 * @package Fingent\CustomAddressDistrict\Setup\Patch\Data
 */
class CreateDistricts implements DataPatchInterface
{
    /**
     * @var DistrictFactory
     */
    private $districtFactory;

    /**
     * CreateDistricts constructor.
     * @param DistrictFactory $districtFactory
     */
    public function __construct(
        DistrictFactory $districtFactory
    ) {
        $this->districtFactory = $districtFactory;
    }

    /**
     * @return DataPatchInterface|void
     * @throws \Exception
     */
    public function apply()
    {
        $sampleData = [
               [
                    'region_id' => '586',
                    'district_name' => 'Alappuzha'
               ],
               [
                    'region_id' => '586',
                    'district_name' => 'Ernakulam'
               ],
               [
                    'region_id' => '586',
                    'district_name' => 'Idukki'
               ],
               [
                    'region_id' => '586',
                    'district_name' => 'Kannur'
               ],
               [
                    'region_id' => '586',
                    'district_name' => 'Kasaragod'
               ],
               [
                    'region_id' => '586',
                    'district_name' => 'Kollam'
               ],
               [
                    'region_id' => '586',
                    'district_name' => 'Kottayam'
               ],
               [
                    'region_id' => '586',
                    'district_name' => 'Kozhikode'
               ],
               [
                    'region_id' => '586',
                    'district_name' => 'Malappuram'
               ],
               [
                    'region_id' => '586',
                    'district_name' => 'Palakkad'
               ],
               [
                    'region_id' => '586',
                    'district_name' => 'Pathanamthitta'
                ],
                [
                        'region_id' => '586',
                        'district_name' => 'Thiruvananthapuram'
                ],
                [
                        'region_id' => '586',
                        'district_name' => 'Thrissur'
                ],
                [
                        'region_id' => '586',
                        'district_name' => 'Wayanad'
                ]
          ];
        foreach ($sampleData as $data) {
            $this->districtFactory->create()->setData($data)->save();
        }
    }

    /**
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }
}
