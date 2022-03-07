<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 6:20 AM
 */
declare(strict_types=1);

namespace Trial\PropertySystem\Ui\Component\Property\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\Url;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Property actions in Listing
 *
 * Class PropertyActions
 */
class PropertyActions extends Column
{
    /**#@+
     * Constant for action URL path
     */
    const URL_PATH_EDIT     = 'properties/properties/edit';
    const URL_PATH_VIEW   = 'properties/properties/view';
    const URL_PATH_DELETE   = 'properties/properties/delete';

    /**#@-*/

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * @var Url
     */
    private $url;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param Escaper $escaper
     * @param Url $url
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        Escaper $escaper,
        Url $url,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->escaper = $escaper;
        $this->url = $url;
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource) : array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['entity_id'])) {
                    $title = $this->escaper->escapeHtml($item['uuid']);

                    $item[$this->getData('name')] = [
                        'view' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_VIEW,
                                [
                                    'entity_id' => $item['entity_id']
                                ]
                            ),
                            'label' => __('View')
                        ],
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'entity_id' => $item['entity_id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'entity_id' => $item['entity_id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete %1', $title),
                                'message' => __('Are you sure you want to delete a %1 record?', $title),
                            ]
                        ]
                    ];
                }
            }
        }
        return $dataSource;
    }
}
