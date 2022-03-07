<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 5:45 PM
 */
namespace Trial\PropertySystem\Api;

use Trial\PropertySystem\Api\Data\PropertySystemInterface;
use Trial\PropertySystem\Api\Data\PropertySystemSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Declared CRUD
 *
 * Interface PropertySystemRepositoryInterface
 */
interface PropertySystemRepositoryInterface
{
    /**
     * Save property
     *
     * @param PropertySystemInterface $property
     * @return PropertySystemInterface
     */
    public function save(PropertySystemInterface $property);

    /**
     * Retrieve property
     *
     * @param int $propertyId
     * @return PropertySystemInterface
     */
    public function getById($propertyId);

    /**
     * Retrieve list matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PropertySystemSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete property
     *
     * @param PropertySystemInterface $property
     * @return bool true on success
     */
    public function delete(PropertySystemInterface $property);

    /**
     * Delete property by ID
     *
     * @param int $propertyId
     * @return bool true on success
     */
    public function deleteById($propertyId);

    /**
     * Get all properties
     * @return mixed
     */
    public function getAllProperties();

    /**
     * Get property by uuid
     * @param $uuid
     * @return mixed
     */
    public function getPropertyByUuid($uuid);
}
