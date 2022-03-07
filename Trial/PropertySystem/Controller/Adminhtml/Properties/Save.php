<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 7:03 AM
 */
namespace Trial\PropertySystem\Controller\Adminhtml\Properties;

use Trial\PropertySystem\Api\Data\PropertySystemInterface;
use Trial\PropertySystem\Api\PropertySystemRepositoryInterface;
use Trial\PropertySystem\Controller\Adminhtml\AbstractController;
use Trial\PropertySystem\Model\PropertySystem;
use Trial\PropertySystem\Model\PropertySystemFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Save property action class
 *
 * Class Save
 */
class Save extends AbstractController implements HttpPostActionInterface
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var PropertySystemFactory
     */
    private $eventFactory;

    /**
     * @var PropertySystemRepositoryInterface
     */
    private $eventRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var PropertySystem
     */
    private $eventModel;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param Context $context
     * @param PropertySystem $eventModel
     * @param PageFactory $resultPageFactory
     * @param DataPersistorInterface $dataPersistor
     * @param PropertySystemFactory $eventFactory
     * @param PropertySystemRepositoryInterface $eventRepository
     * @param LoggerInterface $logger
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        PropertySystem $eventModel,
        PageFactory $resultPageFactory,
        DataPersistorInterface $dataPersistor,
        PropertySystemFactory $eventFactory,
        PropertySystemRepositoryInterface $eventRepository,
        LoggerInterface $logger,
        StoreManagerInterface $storeManager
    ) {
        $this->logger = $logger;
        $this->eventModel = $eventModel;
        $this->storeManager = $storeManager;
        $this->eventFactory = $eventFactory;
        $this->dataPersistor = $dataPersistor;
        $this->eventRepository = $eventRepository;
        parent::__construct($context, $resultPageFactory);
    }

    /**
     * Save event action
     *
     * @return Redirect|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $generalData = $data;

            if (empty($generalData['entity_id'])) {
                $generalData['entity_id'] = null;
            }
            $id = $generalData['entity_id'];

            /** @var Event $model */
            $model = $this->eventFactory->create();

            if ($id) {
                try {
                    $model = $this->eventRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This property no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            $model->setData($generalData);

            try {
                $this->eventRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the property.'));
                return $this->processResultRedirect($model, $resultRedirect, $data);
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Exception $e) {
                $this->logger->info('Property saving issue:' . $e->getMessage());
            }

            $this->dataPersistor->set('property_form', $data);
            return $resultRedirect->setPath('*/*/edit', [
                'entity_id' => $this->getRequest()->getParam('entity_id')
            ]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Process result redirect
     *
     * @param EventInterface $model
     * @param Redirect $resultRedirect
     * @param array $data
     * @return mixed
     */
    private function processResultRedirect($model, $resultRedirect, $data)
    {
        $this->dataPersistor->clear('property_form');
        if ($this->getRequest()->getParam('back')) {
            return $resultRedirect->setPath(
                '*/*/edit',
                ['entity_id' => $model->getId(), '_current' => true]
            );
        }
        return $resultRedirect->setPath('*/*/');
    }
}
