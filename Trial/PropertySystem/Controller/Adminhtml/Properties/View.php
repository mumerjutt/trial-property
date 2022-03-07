<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 7:17 AM
 */
namespace Trial\PropertySystem\Controller\Adminhtml\Properties;

use Magento\Backend\App\Action\Context;
use Trial\PropertySystem\Api\PropertySystemRepositoryInterface;
use Trial\PropertySystem\Controller\Adminhtml\AbstractController;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Show the grid view of properties
 *
 * Class View
 */
class View extends AbstractController implements HttpGetActionInterface
{

    /**
     * @var PropertySystemRepositoryInterface
     */
    private $eventRepository;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param PropertySystemRepositoryInterface $eventRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        PropertySystemRepositoryInterface $eventRepository
    ) {
        $this->eventRepository  = $eventRepository;
        parent::__construct($context, $resultPageFactory);
    }

    /**
     * Create properties index page
     *
     * @return ResponseInterface|ResultInterface|PageFactory
     */
    public function execute()
    {
        $entityId = $this->getRequest()->getParam('entity_id');
        $property = $this->eventRepository->getById($entityId);
        echo '<pre>';
        var_dump($property->getData());
        die();
    }
}
