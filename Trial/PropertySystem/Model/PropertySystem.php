<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 5:44 PM
 */
namespace Trial\PropertySystem\Model;

use Trial\PropertySystem\Api\Data\PropertySystemInterface;
use Trial\PropertySystem\Model\ResourceModel\PropertySystem as ResourceEvent;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class PropertySystem extends AbstractModel implements PropertySystemInterface, IdentityInterface
{
    /**
     * CMS block cache tag
     */
    const CACHE_TAG = 'property';

    /**#@-*/
    /**
     * @var string
     */
    protected $_cacheTag = 'property';

    /**
     * Prefix of model property names
     *
     * @var string
     */
    protected $_eventPrefix = 'property';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Trial\PropertySystem\Model\ResourceModel\PropertySystem::class);
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

    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function getUuid()
    {
        return $this->getData(self::UIID);
    }

    public function getCounty()
    {
        return $this->getData(self::COUNTY);
    }

    public function getCountry()
    {
        return $this->getData(self::COUNTRY);
    }

    public function getTown()
    {
        return $this->getData(self::TOWN);
    }

    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    public function getAddress()
    {
        return $this->getData(self::ADDRESS);
    }

    public function getImageFull()
    {
        return $this->getData(self::IMAGE_FULL);
    }

    public function getImageThumbnail()
    {
        return $this->getData(self::IMAGE_THUMBNAIL);
    }

    public function getLatitude()
    {
        return $this->getData(self::LATITUDE);
    }

    public function getLongitude()
    {
        return $this->getData(self::LONGITUDE);
    }

    public function getNumBedrooms()
    {
        return $this->getData(self::NUM_BEDROOMS);
    }

    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    public function getType()
    {
        return $this->getData(self::TYPE);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function getPropertyTypeID()
    {
        return $this->getData(self::PROPERTY_TYPE_ID);
    }

    public function setUuid($uuid)
    {
        return $this->setData(self::UIID, $uuid);
    }

    public function setCounty($county)
    {
        return $this->setData(self::COUNTY, $county);
    }

    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }

    public function setTown($town)
    {
        return $this->setData(self::TOWN, $town);
    }

    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }

    public function setImageFull($imageFull)
    {
        return $this->setData(self::IMAGE_FULL, $imageFull);
    }

    public function setImageThumbnail($imageThumbnail)
    {
        return $this->setData(self::IMAGE_THUMBNAIL, $imageThumbnail);
    }

    public function setLatitude($latitude)
    {
        return $this->setData(self::LATITUDE, $latitude);
    }

    public function setLongitude($longitude)
    {
        return $this->setData(self::LONGITUDE, $longitude);
    }

    public function setNumBedrooms($bedrooms)
    {
        return $this->setData(self::NUM_BEDROOMS, $bedrooms);
    }

    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }

    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    public function setPropertyTypeId($propertyTypeId)
    {
        return $this->setData(self::PROPERTY_TYPE_ID, $propertyTypeId);
    }

    public function beforeSave()
    {
        if ($this->hasDataChanges()) {
            $this->setUpdatedAt(null);
        }

        return parent::beforeSave();
    }
}
