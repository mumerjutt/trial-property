<?php
declare(strict_types=1);

namespace Trial\PropertySystem\Block\Adminhtml\Property\Edit;

use Trial\PropertySystem\Api\PropertySystemRepositoryInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * For all form buttons
 *
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var PropertySystemRepositoryInterface
     */
    private $eventRepository;

    /**
     * @param Context $context
     * @param PropertySystemRepositoryInterface $eventRepository
     */
    public function __construct(
        Context $context,
        PropertySystemRepositoryInterface $eventRepository
    ) {
        $this->context          = $context;
        $this->eventRepository  = $eventRepository;
    }

    /**
     * Return event ID
     *
     * @return int|null
     */
    public function getEntityId()
    {
        try {
            if (empty($this->context->getRequest()->getParam('entity_id'))) {
                return null;
            }

            return $this->eventRepository->getById(
                $this->context->getRequest()->getParam('entity_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
            $e->getMessage();
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = []) : string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
