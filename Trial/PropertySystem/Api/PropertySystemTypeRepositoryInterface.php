<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 1:41 AM
 */
namespace Trial\PropertySystem\Api;

use Trial\PropertySystem\Api\Data\PropertySystemTypeInterface;
use Trial\PropertySystem\Api\Data\PropertySystemTypeSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Declared CRUD
 *
 * Interface PropertySystemRepositoryInterface
 */
interface PropertySystemTypeRepositoryInterface
{
    /**
     * Save property
     *
     * @param PropertySystemTypeInterface $property
     * @return PropertySystemTypeInterface
     */
    public function save(PropertySystemTypeInterface $property);

    /**
     * Retrieve property
     *
     * @param int $propertyId
     * @return PropertySystemTypeInterface
     */
    public function getById($propertyId);

    /**
     * Retrieve list matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PropertySystemTypeSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete property
     *
     * @param PropertySystemTypeInterface $property
     * @return bool true on success
     */
    public function delete(PropertySystemTypeInterface $property);

    /**
     * Delete property by ID
     *
     * @param int $propertyId
     * @return bool true on success
     */
    public function deleteById($propertyId);

    /**
     * Get current property
     * @param $typeId
     * @return mixed
     */
    public function getCurrentProperty($typeId);
}
