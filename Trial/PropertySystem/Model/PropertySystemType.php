<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 1:41 AM
 */
namespace Trial\PropertySystem\Model;

use Trial\PropertySystem\Api\Data\PropertySystemTypeInterface;
use Trial\PropertySystem\Model\ResourceModel\PropertySystemType as ResourceEvent;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class PropertySystemType extends AbstractModel implements PropertySystemTypeInterface, IdentityInterface
{
    /**
     * CMS block cache tag
     */
    const CACHE_TAG = 'property_type';

    /**#@-*/
    /**
     * @var string
     */
    protected $_cacheTag = 'property_type';

    /**
     * Prefix of model property names
     *
     * @var string
     */
    protected $_eventPrefix = 'property_type';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Trial\PropertySystem\Model\ResourceModel\PropertySystemType::class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getEventId()];
    }


    public function beforeSave()
    {
        if ($this->hasDataChanges()) {
            $this->setUpdatedAt(null);
        }

        return parent::beforeSave();
    }

    public function getTypeId()
    {
        return $this->getData(self::TYPE_ID);
    }

    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setTypeId($typeId)
    {
        return $this->setData(self::TYPE_ID, $typeId);
    }

    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
