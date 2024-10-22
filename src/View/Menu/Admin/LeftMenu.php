<?php

namespace Iidev\CustomUserRoles\View\Menu\Admin;

use XLite\Controller\TitleFromController;
use XLite\Core\Auth;

use XCart\Extender\Mapping\Extender;

/**
 * @Extender\Mixin
 */
class LeftMenu extends \XLite\View\Menu\Admin\LeftMenu
{
    protected function defineItems()
    {
        if (Auth::getInstance()->hasPermission('Virtual assistant')) {
            return [
                'sales' => [
                    static::ITEM_TITLE => static::t('Orders'),
                    static::ITEM_ICON_SVG => 'images/left_menu/orders.svg',
                    static::ITEM_WEIGHT => 100,
                    static::ITEM_TARGET => 'order_list',
                    static::ITEM_WIDGET => 'XLite\View\Menu\Admin\LeftMenu\Sales',
                    static::ITEM_CHILDREN => [
                        'order_list' => [
                            static::ITEM_TITLE => new TitleFromController('order_list'),
                            static::ITEM_TARGET => 'order_list',
                            static::ITEM_PERMISSION => 'virtual assistant',
                            static::ITEM_WIDGET => 'XLite\View\Menu\Admin\LeftMenu\Orders',
                            static::ITEM_LABEL_TITLE => static::t('Orders awaiting processing'),
                            static::ITEM_LABEL_LINK => $this->buildURL('order_list', 'search', ['filter_id' => 'recent']),
                            static::ITEM_WEIGHT => 100,
                        ],
                    ],
                ],
            ];
        }

        return parent::defineItems();
    }
}
