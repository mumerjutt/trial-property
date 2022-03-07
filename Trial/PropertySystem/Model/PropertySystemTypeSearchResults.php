<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 1:41 AM
 */
declare(strict_types=1);

namespace Trial\PropertySystem\Model;

use Trial\PropertySystem\Api\Data\PropertySystemTypeSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with Property search results.
 *
 * Class PropertySystemTypeSearchResults
 */
class PropertySystemTypeSearchResults extends SearchResults implements PropertySystemTypeSearchResultsInterface
{
}
