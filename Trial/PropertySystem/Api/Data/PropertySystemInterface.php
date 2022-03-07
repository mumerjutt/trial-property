<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 5:50 PM
 */
namespace Trial\PropertySystem\Api\Data;

/**
 * Interface class having getter\setter
 *
 * Property System Interface
 */
interface PropertySystemInterface
{
    /**#@+
     * Constants for keys of data array.
     */
    const ENTITY_ID                 = 'entity_id';
    const UIID                      = 'uuid';
    const COUNTY                    = 'county';
    const COUNTRY                   = 'country';
    const TOWN                      = 'town';
    const DESCRIPTION               = 'description';
    const ADDRESS                   = 'address';
    const IMAGE_FULL                = 'image_full';
    const IMAGE_THUMBNAIL           = 'image_thumbnail';
    const LATITUDE                  = 'latitude';
    const LONGITUDE                 = 'longitude';
    const NUM_BEDROOMS              = 'num_bedrooms';
    const PRICE                     = 'price';
    const TYPE                      = 'type';
    const CREATED_AT                = 'created_at';
    const UPDATED_AT                = 'updated_at';
    const PROPERTY_TYPE_ID          = 'property_type_id';

    public function getEntityId();
    public function getUuid();
    public function getCounty();
    public function getCountry();
    public function getTown();
    public function getDescription();
    public function getAddress();
    public function getImageFull();
    public function getImageThumbnail();
    public function getLatitude();
    public function getLongitude();
    public function getNumBedrooms();
    public function getPrice();
    public function getType();
    public function getCreatedAt();
    public function getUpdatedAt();
    public function getPropertyTypeID();
    public function setEntityId($id);
    public function setUuid($uuid);
    public function setCounty($county);
    public function setCountry($country);
    public function setTown($town);
    public function setDescription($description);
    public function setAddress($address);
    public function setImageFull($imageFull);
    public function setImageThumbnail($imageThumbnail);
    public function setLatitude($latitude);
    public function setLongitude($longitude);
    public function setNumBedrooms($bedrooms);
    public function setPrice($price);
    public function setType($type);
    public function setCreatedAt($createdAt);
    public function setUpdatedAt($updatedAt);
    public function setPropertyTypeId($propertyTypeId);
}
