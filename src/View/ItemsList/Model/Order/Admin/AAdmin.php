<?php

namespace Iidev\CustomUserRoles\View\ItemsList\Model\Order\Admin;

use XLite\Core\Auth;

use XCart\Extender\Mapping\Extender;

/**
 * @Extender\Mixin
 */
abstract class AAdmin extends \XLite\View\ItemsList\Model\Order\Admin\AAdmin
{
    protected function checkACL()
    {
        return parent::checkACL() || Auth::getInstance()->hasPermission('Virtual assistant');
    }
}
