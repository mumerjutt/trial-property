<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 7:28 AM
 */
namespace Trial\PropertySystem\Model\Config\Source;

/**
 * ToOption Array conversion class
 *
 * Class SyncTime
 * @package Trial\PropertySystem\Model\Config\Source
 */
class SyncTime implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * ToOption Array conversion
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => '5', 'label' => __('5 minutes')],
            ['value' => '10', 'label' => __('10 minutes')],
            ['value' => '15', 'label' => __('15 minutes')],
            ['value' => '30', 'label' => __('30 minutes')],
            ['value' => '60', 'label' => __('1 hour')],
            ['value' => '120', 'label' => __('2 hours')]
        ];
    }
}
