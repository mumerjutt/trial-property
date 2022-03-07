<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 1:40 AM
 */
namespace Trial\PropertySystem\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\ExtensibleDataInterface;
use Trial\PropertySystem\Api\Data\PropertySystemTypeInterface;

/**
 * Interface for property_system search results.
 *
 * Interface PropertySystemSearchResultsInterface
 */
interface PropertySystemTypeSearchResultsInterface extends SearchResultsInterface
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
     * @param PropertySystemTypeInterface[] $items
     * @return PropertySystemTypeSearchResultsInterface
     */
    public function setItems(array $items);
}
