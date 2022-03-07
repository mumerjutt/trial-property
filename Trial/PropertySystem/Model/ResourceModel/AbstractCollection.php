<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 6:56 PM
 */
declare(strict_types=1);

namespace Trial\PropertySystem\Model\ResourceModel;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Select;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection as AbstractCollectionAlias;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Abstract class for property
 * Class AbstractCollection
 */
abstract class AbstractCollection extends AbstractCollectionAlias
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var MetadataPool
     */
    protected $metadataPool;

    /**
     * @param EntityFactoryInterface $entityFactory
     * @param LoggerInterface $logger
     * @param FetchStrategyInterface $fetchStrategy
     * @param ManagerInterface $managerInterface
     * @param StoreManagerInterface $storeManager
     * @param MetadataPool $metadataPool
     * @param AdapterInterface|null $connection
     * @param AbstractDb|null $resource
     */
    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $managerInterface,
        StoreManagerInterface $storeManager,
        MetadataPool $metadataPool,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    ) {
        $this->logger       = $logger;
        $this->storeManager = $storeManager;
        $this->metadataPool = $metadataPool;
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $managerInterface,
            $connection,
            $resource
        );
    }
}
