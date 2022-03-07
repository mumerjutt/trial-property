<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 9:31 PM
 */
namespace Trial\PropertySystem\Logger;

use Magento\Framework\Logger\Handler\Base as BaseHandler;
use Monolog\Logger;

class Handler extends BaseHandler
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::DEBUG;

    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/propertyapi.log';
}

