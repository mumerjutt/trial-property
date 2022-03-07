<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 7:10 PM
 */
declare(strict_types=1);

namespace Trial\PropertySystem\Model;

use Trial\PropertySystem\Api\Data\PropertySystemSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with Property search results.
 *
 * Class PropertySystemSearchResults
 */
class PropertySystemSearchResults extends SearchResults implements PropertySystemSearchResultsInterface
{
}
