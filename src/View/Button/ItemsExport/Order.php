<?php

namespace Iidev\CustomUserRoles\View\Button\ItemsExport;

use XLite\Core\Auth;
use XCart\Extender\Mapping\Extender;
/**
 * @Extender\Mixin
 */
class Order extends \XLite\View\Button\ItemsExport\Order
{
    protected function getAdditionalButtons()
    {
        if (Auth::getInstance()->hasPermission('Virtual assistant')) {
            return [];
        }

        return parent::getAdditionalButtons();
    }
}
