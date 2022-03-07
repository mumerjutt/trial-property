<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 8:28 PM
 */
namespace Trial\PropertySystem\Model;

use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Phrase;
use Trial\PropertySystem\Helper\Data;
use Magento\Framework\Serialize\Serializer\Json;
use Trial\PropertySystem\Logger\Logger;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Trial\PropertySystem\Api\PropertySystemRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Trial\PropertySystem\Api\PropertySystemTypeRepositoryInterface;
use Trial\PropertySystem\Model\PropertySystemFactory;
use Trial\PropertySystem\Model\PropertySystemTypeFactory;

/**
 * API RUN HANDLER CLASS
 *
 * Class PropertyApiHandler
 * @package Trial\PropertySystem\Model
 */
class PropertyApiHandler
{

    /**
     * @var Data
     */
    private $helper;
    /**
     * @var Curl
     */
    private $curlClient;
    /**
     * @var Json
     */
    private $json;
    /**
     * @var Logger
     */
    private $logger;
    /**
     * @var PropertySystemRepositoryInterface
     */
    private $propertyRepository;
    /**
     * @var PropertySystemTypeRepositoryInterface
     */
    private $propertyTypeRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var FilterBuilder
     */
    private $filterBuilder;
    /**
     * @var \Trial\PropertySystem\Model\PropertySystemFactory
     */
    private $propertyModel;
    /**
     * @var \Trial\PropertySystem\Model\PropertySystemTypeFactory
     */
    private $propertyTypeModel;


    /**
     * @param Curl $curlClient
     * @param Data $helper
     * @param Json $json
     * @param Logger $logger
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param PropertySystemRepositoryInterface $propertyRepository
     * @param FilterBuilder $filterBuilder
     * @param PropertySystemTypeRepositoryInterface $propertySystemTypeRepository
     * @param \Trial\PropertySystem\Model\PropertySystemFactory $propertyModel
     * @param \Trial\PropertySystem\Model\PropertySystemTypeFactory $propertyTypeModel
     */
    public function __construct(
        Curl $curlClient,
        Data $helper,
        Json $json,
        Logger $logger,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        PropertySystemRepositoryInterface $propertyRepository,
        FilterBuilder $filterBuilder,
        PropertySystemTypeRepositoryInterface $propertySystemTypeRepository,
        PropertySystemFactory $propertyModel,
        PropertySystemTypeFactory $propertyTypeModel
    ) {
        $this->curlClient = $curlClient;
        $this->helper = $helper;
        $this->json = $json;
        $this->logger = $logger;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->propertyRepository = $propertyRepository;
        $this->filterBuilder = $filterBuilder;
        $this->propertyTypeRepository = $propertySystemTypeRepository;
        $this->propertyModel = $propertyModel;
        $this->propertyTypeModel = $propertyTypeModel;
    }

    /**
     * CALL API
     * @return Phrase|void
     */
    public function callApi() {
        $apiUrl = $this->helper->getApiUrl();
        $apiKey = $this->helper->getApiKey();
        $apiPageSize = $this->helper->getApiResultPageSize();
        $response = null;
        $count = null;
        try {
            $request = $apiUrl.'?api_key=' . $apiKey;
            $request .= '&page[size]=' . $apiPageSize;
            $this->setCurlOptions();
            $this->getCurlClient()->get($request, []);
            $status = $this->getCurlClient()->getStatus();
            if (($status == 400 || $status == 401)) {
                $message = __('Unspecified OAuth error occurred.');
                $this->logger->debug($message);
                return $message;
            }
            $response = $this->json->unserialize($this->getCurlClient()->getBody());
            $count = $response['last_page'];
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return __('Unspecified error occurred. Please see logs for details.');
        }

        if ($count) {
            $this->fetchApiResults($count, $apiUrl, $apiKey, $apiPageSize);
            $this->logger->info(__('Process completed successfully'));
        } else {
            return __('Unspecified error occurred. No Records return from API Result.');
        }
    }

    /**
     * Fetch API Results
     * @param $count
     * @param $apiUrl
     * @param $apiKey
     * @param $apiPageSize
     * @return Phrase|void
     */
    private function fetchApiResults($count, $apiUrl, $apiKey, $apiPageSize) {

        $allProperties = $this->getAllProperties();
        for ($i = 1; $i <= $count; $i++) {
            try {
                $request = $apiUrl.'?api_key=' . $apiKey;
                $request .= '&page[size]=' . $apiPageSize;
                $request .= '&page[number]=' . $i;
                $this->setCurlOptions();
                $this->getCurlClient()->get($request, []);
                $status = $this->getCurlClient()->getStatus();
                if (($status == 400 || $status == 401)) {
                    $message = __('Unspecified OAuth error occurred.');
                    $this->logger->debug($message);
                    return $message;
                }
                $response = $this->json->unserialize($this->getCurlClient()->getBody());
                $data = $response['data'];

                foreach ($data as $eachProperty) {

                    $uuid = $eachProperty['uuid'];
                    $updatedAt = $eachProperty['updated_at'];
                    $propertyTypeId = $eachProperty['property_type_id'];
                    if (array_key_exists($uuid, $allProperties)) {
                        $currentPropertyTime = $allProperties[$uuid]['updated_at'];
                        $currentPropertyTypeId = $allProperties[$uuid]['type_id'];
                        $currentPropertyToTime = strtotime($currentPropertyTime);
                        $updatedAtToTime = strtotime($updatedAt);
                        if ($updatedAtToTime > $currentPropertyToTime) {
                            $this->addOrUpdateProperty($eachProperty, $currentPropertyTypeId, true);
                        }
                    } else {
                        $this->addOrUpdateProperty($eachProperty, null, false);
                    }
                }
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                return __('Unspecified error occurred. Please see logs for details.');
            }
        }
    }

    /**
     * Add OR Update Property Record
     * @param $eachProperty
     * @param $propertyTypeId
     * @param $isPropertyExist
     */
    private function addOrUpdateProperty($eachProperty, $propertyTypeId, $isPropertyExist) {
        $uuid = $eachProperty['uuid'];
        $newPropertyTypeId = null;
        $propertyType = null;
        $propertyTypeExistFlag = false;
        if ($uuid) {
            $newPropertyTypeId = $eachProperty['property_type_id'];
            if ($newPropertyTypeId == $propertyTypeId) {
                try {
                    $propertyType = $this->propertyTypeRepository->getById($propertyTypeId);
                    if ($propertyType->getTypeId()) {
                        $propertyType->setData('title', $eachProperty['property_type']['title']);
                        $propertyType->setData('description', $eachProperty['property_type']['description']);
                        $this->propertyTypeRepository->save($propertyType);
                        $propertyTypeExistFlag = true;
                    }
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            } else {
                $currentPropertyType = null;
                try {
                    $currentPropertyType = $this->propertyTypeRepository->getCurrentProperty($newPropertyTypeId);
                    $propertyTypeExistFlag = true;
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                }
                if (!$propertyTypeExistFlag) {
                    try {
                        $newPropertyType = $this->propertyTypeModel->create();
                        $newPropertyType->setTitle($eachProperty['property_type']['title']);
                        $newPropertyType->setDescription($eachProperty['property_type']['description']);
                        $newPropertyType->setTypeId($eachProperty['property_type']['id']);
                        $this->propertyTypeRepository->save($newPropertyType);
                        $propertyTypeExistFlag = true;
                    } catch (\Exception $e) {
                        $this->logger->error($e->getMessage());
                    }
                }
            }
            if ($propertyTypeExistFlag) {
                if ($isPropertyExist) {
                    try {
                        $property = $this->propertyRepository->getPropertyByUuid($uuid);
                        $property->setData('county', $eachProperty['county']);
                        $property->setData('country', $eachProperty['country']);
                        $property->setData('town', $eachProperty['town']);
                        $property->setData('description', $eachProperty['description']);
                        $property->setData('address', $eachProperty['address']);
                        $property->setData('image_full', $eachProperty['image_full']);
                        $property->setData('image_thumbnail', $eachProperty['image_thumbnail']);
                        $property->setData('latitude', $eachProperty['latitude']);
                        $property->setData('longitude', $eachProperty['longitude']);
                        $property->setData('num_bedrooms', $eachProperty['num_bedrooms']);
                        $property->setData('price', $eachProperty['price']);
                        $property->setData('type', $eachProperty['type']);
                        $property->setData('property_type_id', $eachProperty['property_type_id']);
                        $this->propertyRepository->save($property);
                    } catch (\Exception $e) {
                        $this->logger->error($e->getMessage());
                    }
                } else {
                    try {
                        $property = $this->propertyModel->create();
                        $property->setData('uuid', $eachProperty['uuid']);
                        $property->setData('county', $eachProperty['county']);
                        $property->setData('country', $eachProperty['country']);
                        $property->setData('town', $eachProperty['town']);
                        $property->setData('description', $eachProperty['description']);
                        $property->setData('address', $eachProperty['address']);
                        $property->setData('image_full', $eachProperty['image_full']);
                        $property->setData('image_thumbnail', $eachProperty['image_thumbnail']);
                        $property->setData('latitude', $eachProperty['latitude']);
                        $property->setData('longitude', $eachProperty['longitude']);
                        $property->setData('num_bedrooms', $eachProperty['num_bedrooms']);
                        $property->setData('price', $eachProperty['price']);
                        $property->setData('type', $eachProperty['type']);
                        $property->setData('property_type_id', $eachProperty['property_type_id']);
                        $this->propertyRepository->save($property);
                    } catch (\Exception $e) {
                        $this->logger->error($e->getMessage());
                    }
                }

            }
        }
    }

    /**
     * Get All Properties
     * @return array
     */
    private function getAllProperties() {
        $properties = null;
        try {
            $properties = $this->propertyRepository->getAllProperties();
        } catch (\Exception $e) {
            $this->logger->info('Error while fetching properties:' . $e->getMessage());
        }
        $allProperties = [];
        if ($properties) {
            foreach ($properties as $property) {
                $allProperties[$property->getUuid()]['updated_at'] = $property->getPropertyUpdatedAt();
                $allProperties[$property->getUuid()]['type_id'] = $property->getPropertyUpdatedAt();
            }
        }
        return $allProperties;
    }

    /**
     * Set curl options
     */
    private function setCurlOptions() {
        $this->getCurlClient()->setOptions(
            [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1
            ]
        );
    }

    /**
     * @return Curl
     */
    private function getCurlClient()
    {
        return $this->curlClient;
    }
}
