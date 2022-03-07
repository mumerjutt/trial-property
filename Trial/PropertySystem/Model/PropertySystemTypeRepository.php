<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 1:41 AM
 */
declare(strict_types=1);

namespace Trial\PropertySystem\Model;

use Magento\Framework\DataObject;
use Trial\PropertySystem\Api\Data\PropertySystemTypeInterface;
use Trial\PropertySystem\Api\Data\PropertySystemTypeSearchResultsInterfaceFactory;
use Trial\PropertySystem\Api\PropertySystemTypeRepositoryInterface;
use Trial\PropertySystem\Model\ResourceModel\PropertySystemType as PropertySystemTypeResource;
use Trial\PropertySystem\Model\ResourceModel\PropertySystemType\Collection;
use Trial\PropertySystem\Model\ResourceModel\PropertySystemType\CollectionFactory as PropertySystemTypeCollectionFactory;
use Trial\PropertySystem\Api\Data\PropertySystemTypeSearchResultsInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * PropertySystemType class CRUD operations
 *
 * Class PropertySystemTypeRepository
 */
class PropertySystemTypeRepository implements PropertySystemTypeRepositoryInterface
{
    /**
     * @var PropertySystemTypeResource
     */
    private $propertySystemResource;

    /**
     * @var PropertySystemTypeFactory
     */
    private $propertySystemFactory;

    /**
     * @var PropertySystemTypeCollectionFactory
     */
    private $propertySystemFactoryCollectionFactory;

    /**
     * @var PropertySystemTypeSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param PropertySystemTypeResource $propertySystemResource
     * @param PropertySystemTypeFactory $propertySystemFactory
     * @param PropertySystemTypeCollectionFactory $propertySystemFactoryCollectionFactory
     * @param PropertySystemTypeSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface|null $collectionProcessor
     */
    public function __construct(
        PropertySystemTypeResource $propertySystemResource,
        PropertySystemTypeFactory $propertySystemFactory,
        PropertySystemTypeCollectionFactory $propertySystemFactoryCollectionFactory,
        PropertySystemTypeSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->propertySystemResource = $propertySystemResource;
        $this->propertySystemFactory = $propertySystemFactory;
        $this->propertySystemFactoryCollectionFactory = $propertySystemFactoryCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Save
     * @param PropertySystemTypeInterface $property
     * @return PropertySystemTypeInterface
     * @throws CouldNotSaveException
     */
    public function save(PropertySystemTypeInterface $property)
    {
        try {
            $this->propertySystemResource->save($property);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the property type: %1', $exception->getMessage()),
                $exception
            );
        }
        return $property;
    }

    /**
     * getById
     * @param $propertyId
     * @return PropertySystemTypeInterface|PropertySystemType
     * @throws NoSuchEntityException
     */
    public function getById($propertyId)
    {
        $property = $this->propertySystemFactory->create();
        $property->load($propertyId);
        if (!$property->getEntityId()) {
            throw new NoSuchEntityException(__('The Property Type with the "%1" ID doesn\'t exist.', $propertyId));
        }
        return $property;
    }

    /**
     * getList
     * @param SearchCriteriaInterface $criteria
     * @return PropertySystemTypeSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria) : PropertySystemTypeSearchResultsInterface
    {
        $collection = $this->propertySystemFactoryCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var PropertySystemTypeSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * getCurrentProperty
     * @param $typeId
     * @return DataObject|mixed
     * @throws NoSuchEntityException
     */
    public function getCurrentProperty($typeId) {
        $property = $this->propertySystemFactoryCollectionFactory->create();
        $property->addFieldToSelect('type_id')
            ->addFieldToFilter('type_id', ['eq' => $typeId]);
        $propertyItem = $property->getFirstItem();
        if (!$propertyItem->getTypeId()) {
            throw new NoSuchEntityException(__('The Property Type with the "%1" ID doesn\'t exist.', $typeId));
        }
        return $propertyItem;
    }

    /**
     * delete
     * @param PropertySystemTypeInterface $property
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(PropertySystemTypeInterface $property) : bool
    {
        try {
            $this->propertySystemResource->delete($property);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the Property Type: %1', $exception->getMessage())
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
                __('Could not delete the Property Type by id: %1', $exception->getMessage())
            );
        }
    }
}
