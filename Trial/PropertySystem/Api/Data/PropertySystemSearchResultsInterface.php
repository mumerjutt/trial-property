<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 6:27 PM
 */
namespace Trial\PropertySystem\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\ExtensibleDataInterface;
use Trial\PropertySystem\Api\Data\PropertySystemInterface;

/**
 * Interface for property_system search results.
 *
 * Interface PropertySystemSearchResultsInterface
 */
interface PropertySystemSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get property list.
     *
     * @return ExtensibleDataInterface[]
     */
    public function getItems();

    /**
     * Set property list.
     *
     * @param PropertySystemInterface[] $items
     * @return PropertySystemSearchResultsInterface
     */
    public function setItems(array $items);
}
