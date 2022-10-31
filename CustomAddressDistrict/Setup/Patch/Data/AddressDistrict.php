<?php

namespace Fingent\CustomAddressDistrict\Setup\Patch\Data;

use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class AddressDistrict
 * @package Fingent\CustomAddressDistrict\Setup\Patch\Data
 */

class AddressDistrict implements DataPatchInterface
{
    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * AddressDistrict constructor.
     * @param Config $eavConfig
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        Config $eavConfig,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavConfig = $eavConfig;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return DataPatchInterface|void
     * @throws LocalizedException
     * @throws \Zend_Validate_Exception
     */
    public function apply()
    {
        $attributeCode = "district";
        $entityType = AddressMetadataInterface::ENTITY_TYPE_ADDRESS;
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute($entityType, $attributeCode, [
            'type'             => 'text',
            'input'            => 'select',
            'label'            => 'District',
            'visible'          => true,
            'required'         => false,
            'user_defined'     => true,
            'system'           => false,
            'group'            => 'General',
            'global'           => true,
            'visible_on_front' => true,
            'sort_order' => 61,
            'position' => 61,
            'source' => \Fingent\CustomAddressDistrict\Model\Address\Attribute\Source\District::class
        ]);

        $attribute = $this->eavConfig->getAttribute($entityType, $attributeCode);
        $attribute->setData(
            'used_in_forms',
            ['adminhtml_customer_address',
                'customer_address_edit',
                'customer_register_address']
        );
        $attribute->save();
    }
}
