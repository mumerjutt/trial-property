<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 7:02 AM
 */
namespace Trial\PropertySystem\Controller\Adminhtml\Properties;

use Trial\PropertySystem\Api\PropertySystemRepositoryInterface;
use Trial\PropertySystem\Controller\Adminhtml\AbstractController;
use Trial\PropertySystem\Model\PropertySystem;
use Trial\PropertySystem\Model\PropertySystemFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Delete events action class
 *
 * Class Delete
 */
class Delete extends AbstractController
{
    /**
     * @var PropertySystemFactory
     */
    private $eventFactory;

    /**
     * @var PropertySystemRepositoryInterface
     */
    private $eventRepository;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param PropertySystemFactory $eventFactory
     * @param PropertySystemRepositoryInterface $eventRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        PropertySystemFactory $eventFactory,
        PropertySystemRepositoryInterface $eventRepository
    ) {
        $this->eventFactory     = $eventFactory;
        $this->eventRepository  = $eventRepository;
        parent::__construct($context, $resultPageFactory);
    }

    /**
     * Delete event action method
     *
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = (int)$this->getRequest()->getParam('entity_id');
        $model = $this->eventFactory->create();

        if ($id) {
            try {
                /** @var Event $model */
                $model = $this->eventRepository->getById($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Property was successfully deleted'));
                return $resultRedirect->setPath('*/*/index');
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
                return $resultRedirect->setPath('*/*/index');
            }
        }

        $this->messageManager->addErrorMessage(__('Property could not be deleted'));
        return $resultRedirect->setPath('*/*/index');
    }
}
