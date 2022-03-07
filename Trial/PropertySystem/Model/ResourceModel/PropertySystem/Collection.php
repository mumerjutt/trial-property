<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 6:53 PM
 */
declare(strict_types=1);

namespace Trial\PropertySystem\Model\ResourceModel\PropertySystem;

use Trial\PropertySystem\Api\Data\PropertySystemInterface;
use Trial\PropertySystem\Model\PropertySystem as PropertySystemModel;
use Trial\PropertySystem\Model\ResourceModel\AbstractCollection;
use Trial\PropertySystem\Model\ResourceModel\PropertySystem as PropertySystemResourceModel;
use Magento\Store\Model\Store;

/**
 * collection for property system model & resource model
 *
 * Property System Collection
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Load data for preview flag
     *
     * @var bool
     */
    protected $_previewFlag;

    /**
     * Event prefix
     *
     * @var string
     */
    protected $eventPrefix = 'property_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $eventObject = 'property_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            PropertySystemModel::class,
            PropertySystemResourceModel::class
        );
    }
}
