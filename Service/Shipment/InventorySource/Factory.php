<?php

/**
 *
 *          ..::..
 *     ..::::::::::::..
 *   ::'''''':''::'''''::
 *   ::..  ..:  :  ....::
 *   ::::  :::  :  :   ::
 *   ::::  :::  :  ''' ::
 *   ::::..:::..::.....::
 *     ''::::::::::::''
 *          ''::''
 *
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Creative Commons License.
 * It is available through the world-wide-web at this URL:
 * http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 * If you are unable to obtain it through the world-wide-web, please send an email
 * to servicedesk@totalinternetgroup.nl so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please contact servicedesk@tig.nl for more information.
 *
 * @copyright   Copyright (c) Total Internet Group B.V. https://tig.nl/copyright
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */
namespace TIG\PostNL\Service\Shipment\InventorySource;

//@codingStandardsIgnoreFile
class Factory
{
    private $objectManager;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager
    ) {
        $this->objectManager = $objectManager;
    }

    /**
     * The InventoryShipping plugin doesn't exist in Magento 2.2.*, but we need it for 2.3.* to set the inventory source
     *
     * @param array $data
     *
     * @return mixed|null
     */
    public function create(array $data = [])
    {
        $instanceName = '\Magento\InventoryShipping\Plugin\Sales\Shipment\AssignSourceCodeToShipmentPlugin';
        $instance = null;
        try {
            $instance = $this->objectManager->create($instanceName, $data);
        } catch (\Exception $exception) {
            // Silent failure, the AssignSourceCodeToShipmentPlugin doesn't exist
        }

        return $instance;
    }
}