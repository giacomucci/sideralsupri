<?php
/**
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @copyright   Copyright (c) 2015 BlueVisionTec UG (haftungsbeschränkt) (http://www.bluevisiontec.de)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Availability attribute model
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Zookal_GShoppingV2_Model_Attribute_Availability
    extends Zookal_GShoppingV2_Model_Attribute_Default
{
    protected $_googleAvailabilityMap = [
        0 => 'out of stock',
        1 => 'in stock'
    ];

    /**
     * Set current attribute to entry (for specified product)
     *
     * @param Mage_Catalog_Model_Product             $product
     * @param Google_Service_ShoppingContent_Product $shoppingProduct
     *
     * @return Google_Service_ShoppingContent_Product
     */
    public function convertAttribute($product, $shoppingProduct)
    {
        $sp = $this->_dispatch('gshoppingv2_attribute_availability', $product, $shoppingProduct);
        if ($sp !== null) {
            return $sp;
        }

        $value = $this->_googleAvailabilityMap[(int)$product->isSalable()];

        if ($product->getTypeId() == "configurable") {
            $value = $this->_googleAvailabilityMap[1];
        }

        return $shoppingProduct->setAvailability($value);
    }
}
