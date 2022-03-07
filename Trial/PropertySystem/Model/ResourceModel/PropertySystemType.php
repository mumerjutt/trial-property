<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 1:54 AM
 */

/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 6:42 PM
 */
declare(strict_types=1);

namespace Trial\PropertySystem\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\EntityManager;
use Psr\Log\LoggerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Trial\PropertySystem\Api\Data\PropertySystemTypeInterface;
use Magento\Framework\DB\Select;

/**
 * mysql resource class
 *
 * Class PropertySystemType
 */
class PropertySystemType extends AbstractDb
{
    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Context $context
     * @param MetadataPool $metadataPool
     * @param EntityManager $entityManager
     * @param LoggerInterface $logger
     * @param StoreManagerInterface $storeManager
     * @param null $connectionName
     */
    public function __construct(
        Context               $context,
        MetadataPool          $metadataPool,
        EntityManager         $entityManager,
        LoggerInterface       $logger,
        StoreManagerInterface $storeManager,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->logger = $logger;
        $this->metadataPool = $metadataPool;
        $this->storeManager = $storeManager;
        $this->entityManager = $entityManager;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('property_type', 'id');
    }

}
