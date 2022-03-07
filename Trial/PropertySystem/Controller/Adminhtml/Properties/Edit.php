<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 6:34 AM
 */
namespace Trial\PropertySystem\Controller\Adminhtml\Properties;

use Trial\PropertySystem\Api\PropertySystemRepositoryInterface;
use Trial\PropertySystem\Controller\Adminhtml\AbstractController;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Action class to edit/update the property
 *
 * Class Edit
 */
class Edit extends AbstractController implements HttpGetActionInterface
{
    /**
     * @var PropertySystemRepositoryInterface
     */
    private $eventRepository;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param DataPersistorInterface $dataPersistor
     * @param PropertySystemRepositoryInterface $eventRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        DataPersistorInterface $dataPersistor,
        PropertySystemRepositoryInterface $eventRepository
    ) {
        $this->dataPersistor    = $dataPersistor;
        $this->eventRepository  = $eventRepository;
        parent::__construct($context, $resultPageFactory);
    }

    /**
     * Method to edit the event data
     *
     * @return Page|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $eventId = $this->getRequest()->getParam('entity_id');

        if ($eventId) {
            $this->dataPersistor->set('current_event_id', $eventId);
            $this->_init($resultPage)->addBreadcrumb(__('Edit Property'), __('Edit Property'));
            $resultPage->getConfig()->getTitle()->prepend(
                $this->eventRepository->getById($eventId)->getUuid()
            );
        } else {
            $this->_init($resultPage)->addBreadcrumb(__('New Property'), __('New Property'));
            $resultPage->getConfig()->getTitle()->prepend(__('New Property'));
        }
        return $resultPage;
    }
}
