<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 6/3/22
 * Time: 7:54 PM
 */
namespace Trial\PropertySystem\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Trial\PropertySystem\Model\PropertyApiHandler;
use Trial\PropertySystem\Logger\Logger;

/**
 * Run API
 *
 * Class RunApi
 * @package Trial\PropertySystem\Console\Command
 */
class RunApi extends Command
{
    /**
     * @var PropertyApiHandler
     */
    private $propertyHandler;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param PropertyApiHandler $propertyHandler
     * @param Logger $logger
     */
    public function __construct(
        PropertyApiHandler $propertyHandler,
        Logger $logger
    ) {
        $this->propertyHandler = $propertyHandler;
        $this->logger = $logger;
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('trial:property');
        $this->setDescription('Command to execute property system API and save data.');
        parent::configure();
    }

    /**
     * Run API
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->propertyHandler->callApi();
        $output->writeln('<info>Execution Completed.</info>');
    }
}
