<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 7:36 AM
 */
namespace Trial\PropertySystem\Cron;

use Trial\PropertySystem\Model\PropertyApiHandler;

/**
 * Cron job
 *
 * Class SyncProperties
 * @package Trial\PropertySystem\Cron
 */
class SyncProperties
{
    /**
     * @var PropertyApiHandler
     */
    private $propertyHandler;

    /**
     * @param PropertyApiHandler $propertyHandler
     */
    public function __construct(
        PropertyApiHandler $propertyHandler
    ) {
        $this->propertyHandler = $propertyHandler;
    }

    /**
     * Run API
     */
    protected function execute()
    {
        $this->propertyHandler->callApi();
    }
}
