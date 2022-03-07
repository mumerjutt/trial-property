<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 6:43 AM
 */
declare(strict_types=1);

namespace Trial\PropertySystem\Ui\DataProvider\Property\Form;

use Trial\PropertySystem\Model\ResourceModel\PropertySystem\CollectionFactory;
use Magento\Catalog\Model\Category\FileInfo;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * This class is used to get add/edit form data
 *
 * Class DataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var array
     */
    private $loadedData;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var FileInfo
     */
    private $fileInfo;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param FileInfo $fileInfo
     * @param CollectionFactory $eventCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param StoreManagerInterface $storeManagerInterface
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        FileInfo $fileInfo,
        CollectionFactory $eventCollectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManagerInterface,
        array $meta = [],
        array $data = []
    ) {
        $this->fileInfo         = $fileInfo;
        $this->collection       = $eventCollectionFactory->create();
        $this->storeManager     = $storeManagerInterface;
        $this->dataPersistor    = $dataPersistor;
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        /** @var CollectionFactory $items */
        $items = $this->collection->getItems();
        foreach ($items as $event) {
            $this->loadedData[$event->getEntityId()] = $event->getData();
        }

        $data = $this->dataPersistor->get('property_form');
        if (!empty($data)) {
            $event = $this->collection->getNewEmptyItem();
            $event->setData($data);
            $this->loadedData[$event->getId()] = $event->getData();
            $this->dataPersistor->clear('property_form');
        }
        return $this->loadedData;
    }
}
