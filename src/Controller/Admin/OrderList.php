<?php

namespace Iidev\CustomUserRoles\Controller\Admin;

use XLite\Core\Auth;

use XCart\Extender\Mapping\Extender;
/**
 * @Extender\Mixin
 */
class OrderList extends \XLite\Controller\Admin\OrderList
{
    public function checkACL()
    {
        return parent::checkACL() || Auth::getInstance()->hasPermission('Virtual assistant');
    }

    protected function doActionUpdateItemsList()
    {
        if (Auth::getInstance()->hasPermission('Virtual assistant')) {
            \XLite\Core\TopMessage::addError('Access denied!');

            return;
        }

        parent::doActionUpdateItemsList();
    }
}
