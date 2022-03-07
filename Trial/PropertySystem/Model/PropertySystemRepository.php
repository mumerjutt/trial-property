<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 6:57 PM
 */
declare(strict_types=1);

namespace Trial\PropertySystem\Model;

use Trial\PropertySystem\Api\Data\PropertySystemInterface;
use Trial\PropertySystem\Api\Data\PropertySystemSearchResultsInterfaceFactory;
use Trial\PropertySystem\Api\PropertySystemRepositoryInterface;
use Trial\PropertySystem\Model\ResourceModel\PropertySystem as PropertySystemResource;
use Trial\PropertySystem\Model\ResourceModel\PropertySystem\Collection;
use Trial\PropertySystem\Model\ResourceModel\PropertySystem\CollectionFactory as PropertySystemCollectionFactory;
use Trial\PropertySystem\Api\Data\PropertySystemSearchResultsInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * PropertySystem class CRUD operations
 *
 * Class PropertySystemRepository
 */
class PropertySystemRepository implements PropertySystemRepositoryInterface
{
    /**
     * @var PropertySystemResource
     */
    private $propertySystemResource;

    /**
     * @var PropertySystemFactory
     */
    private $propertySystemFactory;

    /**
     * @var PropertySystemCollectionFactory
     */
    private $propertySystemFactoryCollectionFactory;

    /**
     * @var PropertySystemSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param PropertySystemResource $propertySystemResource
     * @param PropertySystemFactory $propertySystemFactory
     * @param PropertySystemCollectionFactory $propertySystemFactoryCollectionFactory
     * @param PropertySystemSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface|null $collectionProcessor
     */
    public function __construct(
        PropertySystemResource $propertySystemResource,
        PropertySystemFactory $propertySystemFactory,
        PropertySystemCollectionFactory $propertySystemFactoryCollectionFactory,
        PropertySystemSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->propertySystemResource = $propertySystemResource;
        $this->propertySystemFactory = $propertySystemFactory;
        $this->propertySystemFactoryCollectionFactory = $propertySystemFactoryCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Save property
     * @param PropertySystemInterface $property
     * @return PropertySystemInterface
     * @throws CouldNotSaveException
     */
    public function save(PropertySystemInterface $property)
    {
        try {
            $this->propertySystemResource->save($property);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the property: %1', $exception->getMessage()),
                $exception
            );
        }
        return $property;
    }

    /**
     * Get property by id
     * @param $propertyId
     * @return PropertySystemInterface|PropertySystem
     * @throws NoSuchEntityException
     */
    public function getById($propertyId)
    {
        $property = $this->propertySystemFactory->create();
        $property->load($propertyId);
        if (!$property->getEntityId()) {
            throw new NoSuchEntityException(__('The Property with the "%1" ID doesn\'t exist.', $propertyId));
        }
        return $property;
    }

    /**
     * Get list
     * @param SearchCriteriaInterface $criteria
     * @return PropertySystemSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria) : PropertySystemSearchResultsInterface
    {
        $collection = $this->propertySystemFactoryCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var PropertySystemSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Get all properties
     * @return \Magento\Framework\DataObject[]|mixed|null
     */
    public function getAllProperties()
    {
        $property = $this->propertySystemFactoryCollectionFactory->create();
        $property->addFieldToSelect('entity_id')
            ->addFieldToSelect('uuid')
            ->addFieldToSelect('property_type_id')
            ->addFieldToSelect('updated_at', 'property_updated_at');
        if ($property) {
            return $property->getItems();
        } else {
            return null;
        }
    }

    /**
     * get property by uuid
     * @param $uuid
     * @return \Magento\Framework\DataObject|mixed|null
     */
    public function getPropertyByUuid($uuid)
    {
        $property = $this->propertySystemFactoryCollectionFactory->create();
        $property = $property->addFieldToSelect('*')
            ->addFieldToFilter('uuid', ['eq' => $uuid]);
        if ($property) {
            return $property->getFirstItem();
        } else {
            return null;
        }
    }

    /**
     * Delete property
     * @param PropertySystemInterface $property
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(PropertySystemInterface $property) : bool
    {
        try {
            $this->propertySystemResource->delete($property);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the Property: %1', $exception->getMessage())
            );
        }
        return true;
    }

    /**
     * Delete Property by given Id
     *
     * @param int $propertyId
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function deleteById($propertyId) : bool
    {
        try {
            return $this->delete($this->getById($propertyId));
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the Property by id: %1', $exception->getMessage())
            );
        }
    }
}
