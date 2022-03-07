<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 6:39 AM
 */
declare(strict_types=1);

namespace Trial\PropertySystem\Block\Adminhtml\Property\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * For delete button on create/edit Property
 *
 * Class DeleteButton
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get delete button data
     *
     * @return array
     */
    public function getButtonData() : array
    {
        $data = [];
        if ($this->getEntityId()) {
            $data = [
                'label' => __('Delete Property'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * Url to send delete requests to.
     *
     * @return string
     */
    public function getDeleteUrl() : string
    {
        return $this->getUrl('*/*/delete', ['entity_id' => $this->getEntityId()]);
    }
}
