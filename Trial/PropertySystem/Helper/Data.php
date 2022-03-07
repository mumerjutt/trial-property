<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 8:02 PM
 */
namespace Trial\PropertySystem\Helper;

use Magento\Framework\App\Helper\AbstractHelper as AbstractHelperAlias;
use Magento\Store\Model\ScopeInterface;

/**
 * Helper class
 *
 * Class Data
 * @package Trial\PropertySystem\Helper
 */
class Data extends AbstractHelperAlias
{
    /**
     *
     */
    const XML_PROPERTYSYSTEM_GENERAL_API_URL = 'propertysystem/general/api_url';
    /**
     *
     */
    const XML_PROPERTYSYSTEM_GENERAL_API_KEY = 'propertysystem/general/api_key';
    /**
     *
     */
    const XML_PROPERTYSYSTEM_GENERAL_API_PAGE_SIZE = 'propertysystem/general/api_page_size';

    /**
     * Get API Url
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->scopeConfig->getValue(self::XML_PROPERTYSYSTEM_GENERAL_API_URL, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get API Key
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->scopeConfig->getValue(self::XML_PROPERTYSYSTEM_GENERAL_API_KEY, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get API Page Size LIMIT
     * @return mixed
     */
    public function getApiResultPageSize()
    {
        return $this->scopeConfig->getValue(self::XML_PROPERTYSYSTEM_GENERAL_API_PAGE_SIZE, ScopeInterface::SCOPE_STORE);
    }
}
