<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 6:38 AM
 */
declare(strict_types=1);

namespace Trial\PropertySystem\Block\Adminhtml\Property\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * For back button on create/edit property
 *
 * Class BackButton
 */
class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get back button data
     *
     * @return array
     */
    public function getButtonData() : array
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl() : string
    {
        return $this->getUrl('*/*/');
    }
}
