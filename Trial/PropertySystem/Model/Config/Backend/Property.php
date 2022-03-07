<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 7:28 AM
 */
namespace Trial\PropertySystem\Model\Config\Backend;

use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;

/**
 * Sync time
 *
 * Class Property
 * @package Trial\PropertySystem\Model\Config\Backend
 */
class Property extends \Magento\Framework\App\Config\Value
{
    /**
     * @param Context $context
     * @param Registry $registry
     * @param ScopeConfigInterface $config
     * @param TypeListInterface $cacheTypeList
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ScopeConfigInterface $config,
        TypeListInterface $cacheTypeList,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    /**
     * After load changes
     * @return Property|void
     */
    public function afterLoad(){

        $value = $this->getValue();
        $value = preg_replace('/[^0-9]/', '', $value);
        if($value == 5){
            $this->setValue(5);
        }

        if($value == 10){
            $this->setValue(10);
        }

        if($value == 15){
            $this->setValue(15);
        }

        if($value == 30){
            $this->setValue(30);
        }

        if($value == 1){
            $this->setValue(60);
        }

        if($value == 2){
            $this->setValue(120);
        }

        parent::afterLoad();

    }

    /**
     * Before save changes
     * @return Property|void
     */
    public function beforeSave()
    {

        $label = $this->getData('propertysystem/general/sync_time');

        if ($this->getValue() == 5) {

            $this->setValue('*/5 * * * *');

        } else if ($this->getValue() == 10) {

            $this->setValue('*/10 * * * *');

        } else if ($this->getValue() == 15) {

            $this->setValue('*/15 * * * *');

        } else if ($this->getValue() == 30) {

            $this->setValue('*/30 * * * *');

        } else if ($this->getValue() == 60) {

            $this->setValue('* */1 * * *');

        }else {

            $this->setValue('* */2 * * *');

        }

        parent::beforeSave();

    }
}
