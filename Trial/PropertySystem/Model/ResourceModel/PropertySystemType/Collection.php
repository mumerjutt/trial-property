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

namespace Trial\PropertySystem\Model\ResourceModel\PropertySystemType;

use Trial\PropertySystem\Api\Data\PropertySystemTypeInterface;
use Trial\PropertySystem\Model\PropertySystemType as PropertySystemTypeModel;
use Trial\PropertySystem\Model\ResourceModel\AbstractCollection;
use Trial\PropertySystem\Model\ResourceModel\PropertySystemType as PropertySystemTypeResourceModel;
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
    protected $_idFieldName = 'id';

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
    protected $eventPrefix = 'property_type_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $eventObject = 'property_type_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            PropertySystemTypeModel::class,
            PropertySystemTypeResourceModel::class
        );
    }
}
