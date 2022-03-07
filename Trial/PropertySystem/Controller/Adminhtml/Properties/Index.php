<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 6:06 AM
 */
namespace Trial\PropertySystem\Controller\Adminhtml\Properties;

use Trial\PropertySystem\Controller\Adminhtml\AbstractController;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Show the grid view of properties
 *
 * Class Index
 */
class Index extends AbstractController implements HttpGetActionInterface
{
    /**
     * Create properties index page
     *
     * @return ResponseInterface|ResultInterface|PageFactory
     */
    public function execute()
    {
        /** @var PageFactory $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->_init($resultPage)->getConfig()->getTitle()->prepend(__('Manage Properties'));
        return $resultPage;
    }
}
