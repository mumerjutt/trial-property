<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 6:07 AM
 */
namespace Trial\PropertySystem\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * AbstractController class for actions
 */
abstract class AbstractController extends Action
{
    /**#@+
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Trial_PropertySystem::properties';
    /**#@-*/

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * This method is used to init breadcrumbs
     *
     * @param $resultPage
     * @return mixed
     */
    protected function _init($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Trial'), __('PropertySystem'))
            ->addBreadcrumb(__('Manage Properties'), __('Manage Properties'));

        return $resultPage;
    }
}
