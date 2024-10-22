<?php

namespace Iidev\CustomUserRoles\View\Pager;

use XLite\Core\Auth;

use XCart\Extender\Mapping\Extender;

/**
 * @Extender\Mixin
 */
abstract class APager extends \XLite\View\Pager\APager
{
    protected function getMaxItemsCount()
    {
        return Auth::getInstance()->hasPermission('Virtual assistant') ? 1 : parent::getMaxItemsCount();
    }
}
